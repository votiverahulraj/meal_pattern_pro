<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFile;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            // Admin can see all products
            $products = Product::with(['district', 'files'])->paginate(15);
        } else {
            // District user can only see their own products
            $products = Product::where('district_id', $user->district_id)
                             ->with(['district', 'files'])
                             ->paginate(15);
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Product::class);
        
        $districts = District::all();
        return view('products.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'product_code' => 'nullable|string|max:255|unique:products,product_code',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
            'nutritional_info' => 'nullable|array',
            'packaging' => 'nullable|string',
            'storage_requirements' => 'nullable|string',
            'preparation_instructions' => 'nullable|string',
            'certifications' => 'nullable|string',
            'meal_pattern_contributions' => 'nullable|array',
            'cn_statements' => 'nullable|array',
        ]);

        $user = Auth::user();
        $districtId = $user->hasRole('admin') ? $request->district_id : $user->district_id;

        $product = Product::create([
            'district_id' => $districtId,
            'manufacturer_id' => $user->id,
            'name' => $request->name,
            'brand' => $request->brand,
            'category' => $request->category,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'allergens' => $request->allergens,
            'nutritional_info' => $request->nutritional_info,
            'packaging' => $request->packaging,
            'storage_requirements' => $request->storage_requirements,
            'preparation_instructions' => $request->preparation_instructions,
            'certifications' => $request->certifications,
            'meal_pattern_contributions' => $request->meal_pattern_contributions,
            'cn_statements' => $request->cn_statements,
            'status' => 'active',
        ]);

        return redirect()->route('products.show', $product->id)->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        
        $product->load(['district', 'files']);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        
        $districts = District::all();
        return view('products.edit', compact('product', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'product_code' => 'nullable|string|max:255|unique:products,product_code,' . $product->id,
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
            'nutritional_info' => 'nullable|array',
            'packaging' => 'nullable|string',
            'storage_requirements' => 'nullable|string',
            'preparation_instructions' => 'nullable|string',
            'certifications' => 'nullable|string',
            'meal_pattern_contributions' => 'nullable|array',
            'cn_statements' => 'nullable|array',
        ]);

        $user = Auth::user();
        $districtId = $user->hasRole('admin') ? $request->district_id : $product->district_id;

        $product->update([
            'district_id' => $districtId,
            'name' => $request->name,
            'brand' => $request->brand,
            'category' => $request->category,
            'product_code' => $request->product_code,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'allergens' => $request->allergens,
            'nutritional_info' => $request->nutritional_info,
            'packaging' => $request->packaging,
            'storage_requirements' => $request->storage_requirements,
            'preparation_instructions' => $request->preparation_instructions,
            'certifications' => $request->certifications,
            'meal_pattern_contributions' => $request->meal_pattern_contributions,
            'cn_statements' => $request->cn_statements,
        ]);

        return redirect()->route('products.show', $product->id)->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Browse products (for district users).
     */
    public function browse()
    {
        $user = Auth::user();
        
        $products = Product::where('status', 'active')
                          ->when(!$user->hasRole('admin'), function ($query) use ($user) {
                              return $query->where('district_id', $user->district_id);
                          })
                          ->with(['district', 'files'])
                          ->paginate(15);

        return view('products.browse', compact('products'));
    }

    /**
     * Save product to user's collection.
     */
    public function saveToCollection(Product $product)
    {
        $user = Auth::user();
        
        // For now, just redirect back with success message
        // In a real implementation, you would link the product to the user's collection
        return redirect()->back()->with('success', 'Product saved to your collection.');
    }

    /**
     * Upload product file (CN Label, PFS, etc.).
     */
    public function uploadFile(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
            'file_type' => 'required|in:cn_label,pfs,pss'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('product_files', $filename, 'public');

            $productFile = ProductFile::create([
                'product_id' => $product->id,
                'filename' => $filename,
                'original_filename' => $file->getClientOriginalName(),
                'file_path' => $filePath,
                'file_type' => $request->file_type,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'uploaded_by' => Auth::id(),
                'status' => 'pending'
            ]);

            // In a real implementation, you would trigger a job to extract data from the file
            // dispatch(new ProcessProductFileJob($productFile));
        }

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
}
