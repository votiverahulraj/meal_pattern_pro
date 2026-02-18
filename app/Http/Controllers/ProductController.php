<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFile;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;


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
            $products = Product::with(['district', 'files'])
                    ->orderBy('id', 'desc')
                    ->paginate(15);      
              } else {
            // District user can only see their own products
             $products = Product::where('district_id', $user->district_id)
                    ->with(['district', 'files'])
                    ->orderBy('id', 'desc')
                    ->paginate(15);
        }

        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd("test");
        // $this->authorize('create', Product::class);
        
        $districts = District::all();
        return view('pages.products.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
        // dd( $request->all());

    $request->validate([

        'name' => 'required|string|max:255',
        'brand' => 'nullable|string|max:255',
        'category' => 'nullable|string|max:255',
        'product_code' => 'nullable|string|max:255|unique:products,product_code',

        'description' => 'nullable|string',
        'ingredients' => 'nullable|string',
        'allergens' => 'nullable|string',

        'nutritional_info' => 'nullable|string',
        'meal_pattern_contributions' => 'nullable|string',
        'cn_statements' => 'nullable|string',

        'packaging' => 'nullable|string',
        'storage_requirements' => 'nullable|string',
        'preparation_instructions' => 'nullable|string',
        'certifications' => 'nullable|string',

        // FILE VALIDATION
       'product_specification_sheet' => 'nullable|file',
        'product_formulation_statement' => 'nullable|file',
        'buy_american_complaince' => 'nullable|file',
    ]);

    $user = Auth::user();

    $districtId = $user->hasRole('admin')
        ? $request->district_id
        : $user->district_id;

    // FILE UPLOAD
    $specSheet = $request->file('product_specification_sheet')
        ? $request->file('product_specification_sheet')->store('products/documents', 'public')
        : null;

    $formulation = $request->file('product_formulation_statement')
        ? $request->file('product_formulation_statement')->store('products/documents', 'public')
        : null;

    $compliance = $request->file('buy_american_complaince')
        ? $request->file('buy_american_complaince')->store('products/documents', 'public')
        : null;


    // SAVE PRODUCT
     Product::create([

        'district_id' => $request->district_id,
        'manufacturer_id' => $request->manufacturer_id,

        'name' => $request->name,
        'nutri_code' => $request->nutri_code,
        'manufacturer' => $request->manufacturer,
        'product_number' => $request->product_number,

        'unit_size' => $request->unit_size,
        'serving_size' => $request->serving_size,
        'case_pack' => $request->case_pack,
        'shift_life' => $request->shift_life,

        'calories' => $request->calories,
        'protein' => $request->protein,
        'carbs' => $request->carbs,
        'fat' => $request->fat,
        'sat_fat' => $request->sat_fat,
        'trans_fat' => $request->trans_fat,

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

        // FILE PATH
        'product_specification_sheet' => $specSheet,
        'product_formulation_statement' => $formulation,
        'buy_american_complaince' => $compliance,

        'status' => $request->status,
    ]);

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $this->authorize('view', $product);
        
        $product->load(['district', 'files']);
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // $this->authorize('update', $product);
        
        $districts = District::all();
        return view('pages.products.edit', compact('product', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd( $request->all());
        $request->validate([

            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'product_code' => 'nullable|string|max:255|unique:products,product_code,' . $product->id,

            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',

            'nutritional_info' => 'nullable|string',

            'packaging' => 'nullable|string',
            'storage_requirements' => 'nullable|string',
            'preparation_instructions' => 'nullable|string',
            'certifications' => 'nullable|string',

            'meal_pattern_contributions' => 'nullable|string',
            'cn_statements' => 'nullable|string',

            // FILE VALIDATION
            'product_specification_sheet' => 'nullable|file',
            'product_formulation_statement' => 'nullable|file',
            // 'buy_american_complaince' => 'nullable|file',
        ]);

        $user = Auth::user();

        $districtId = $user->hasRole('admin')
            ? $request->district_id
            : $product->district_id;

           
        // FILE UPLOAD LOGIC

        $specSheet = $product->product_specification_sheet;
        if ($request->hasFile('product_specification_sheet')) {

            // delete old file
            if ($product->product_specification_sheet && Storage::disk('public')->exists($product->product_specification_sheet)) {
                Storage::disk('public')->delete($product->product_specification_sheet);
            }

            // upload new file
            $specSheet = $request->file('product_specification_sheet')
                ->store('products/documents', 'public');
        }


        $formulation = $product->product_formulation_statement;
        if ($request->hasFile('product_formulation_statement')) {

            if ($product->product_formulation_statement && Storage::disk('public')->exists($product->product_formulation_statement)) {
                Storage::disk('public')->delete($product->product_formulation_statement);
            }

            $formulation = $request->file('product_formulation_statement')
                ->store('products/documents', 'public');
        }


        $compliance = $product->buy_american_complaince;
        if ($request->hasFile('buy_american_complaince')) {

            if ($product->buy_american_complaince && Storage::disk('public')->exists($product->buy_american_complaince)) {
                Storage::disk('public')->delete($product->buy_american_complaince);
            }

            $compliance = $request->file('buy_american_complaince')
                ->store('products/documents', 'public');
        }

       // DELETE FILES LOGIC
        if($request->delete_files)
        {
            foreach($request->delete_files as $field)
            {
                if($product->$field && Storage::disk('public')->exists($product->$field))
                {
                    Storage::disk('public')->delete($product->$field);
                }

                if($field == 'product_specification_sheet'){
                    $specSheet = null;
                }

                if($field == 'product_formulation_statement'){
                    $formulation = null;
                }

                if($field == 'buy_american_complaince'){
                    $compliance = null;
                }
            }
        }

        // UPDATE PRODUCT

        $product->update([

            'district_id' => $districtId,

           'name' => $request->name,
        'nutri_code' => $request->nutri_code,
        'manufacturer' => $request->manufacturer,
        'product_number' => $request->product_number,

        'unit_size' => $request->unit_size,
        'serving_size' => $request->serving_size,
        'case_pack' => $request->case_pack,
        'shift_life' => $request->shift_life,

        'calories' => $request->calories,
        'protein' => $request->protein,
        'carbs' => $request->carbs,
        'fat' => $request->fat,
        'sat_fat' => $request->sat_fat,
        'trans_fat' => $request->trans_fat,

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

        // FILE PATH
        'product_specification_sheet' => $specSheet,
        'product_formulation_statement' => $formulation,
        'buy_american_complaince' => $compliance,

        'status' => $request->status,
        ]);
        

        return redirect()
            ->route('admin.products.index', $product->id)
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // $this->authorize('delete', $product);
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
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
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Products Imported Successfully');
    }
    
    public function export()
    {
        return Excel::download(new ProductsExport, 'products_template.xlsx');
    }
    
}
