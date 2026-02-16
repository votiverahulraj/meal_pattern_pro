<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\District;
use App\Models\Communication;
use App\Models\Payment;
use App\Models\PaymentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            // Admin can see all families
            $families = Family::with(['district'])->paginate(15);
        } else {
            // Regular user can only see families in their district
            $families = Family::where('district_id', $user->district_id)
                            ->with(['district'])
                            ->paginate(15);
        }

        return view('families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Family::class);
        
        $districts = District::all();
        return view('families.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'primary_contact_name' => 'required|string|max:255',
            'student_names' => 'required|string',
            'outstanding_balance' => 'required|numeric|min:0',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:10',
            'recovery_status' => 'required|in:active,payment_plan,paid,inactive',
            'collection_status' => 'required|in:received,in_collections',
        ]);

        $user = Auth::user();
        $districtId = $user->hasRole('admin') ? $request->district_id : $user->district_id;

        $family = Family::create([
            'district_id' => $districtId,
            'primary_contact_name' => $request->primary_contact_name,
            'student_names' => $request->student_names,
            'outstanding_balance' => $request->outstanding_balance,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'recovery_status' => $request->recovery_status,
            'collection_status' => $request->collection_status,
        ]);

        return redirect()->route('families.show', $family->id)->with('success', 'Family record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        $this->authorize('view', $family);
        
        $family->load(['district', 'communications', 'payments', 'paymentPlans']);
        return view('families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        $this->authorize('update', $family);
        
        $districts = District::all();
        return view('families.edit', compact('family', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        $this->authorize('update', $family);
        
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'primary_contact_name' => 'required|string|max:255',
            'student_names' => 'required|string',
            'outstanding_balance' => 'required|numeric|min:0',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:10',
            'recovery_status' => 'required|in:active,payment_plan,paid,inactive',
            'collection_status' => 'required|in:received,in_collections',
        ]);

        $user = Auth::user();
        $districtId = $user->hasRole('admin') ? $request->district_id : $family->district_id;

        $family->update([
            'district_id' => $districtId,
            'primary_contact_name' => $request->primary_contact_name,
            'student_names' => $request->student_names,
            'outstanding_balance' => $request->outstanding_balance,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'recovery_status' => $request->recovery_status,
            'collection_status' => $request->collection_status,
        ]);

        return redirect()->route('families.show', $family->id)->with('success', 'Family record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        $this->authorize('delete', $family);
        
        $family->delete();

        return redirect()->route('families.index')->with('success', 'Family record deleted successfully.');
    }

    /**
     * Search families.
     */
    public function search(Request $request)
    {
        $user = Auth::user();
        
        $query = Family::query();
        
        // Apply filters based on request parameters
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('primary_contact_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('student_names', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('account_number', 'LIKE', '%' . $request->search . '%');
            });
        }
        
        if ($request->has('recovery_status') && $request->recovery_status) {
            $query->where('recovery_status', $request->recovery_status);
        }
        
        if ($request->has('collection_status') && $request->collection_status) {
            $query->where('collection_status', $request->collection_status);
        }
        
        if ($request->has('balance_min') && $request->balance_min) {
            $query->where('outstanding_balance', '>=', $request->balance_min);
        }
        
        if ($request->has('balance_max') && $request->balance_max) {
            $query->where('outstanding_balance', '<=', $request->balance_max);
        }
        
        if ($request->has('priority') && $request->priority && $user->hasRole('admin')) {
            $query->where('recovery_priority', $request->priority);
        }
        
        // Apply district filter for non-admin users
        if (!$user->hasRole('admin')) {
            $query->where('district_id', $user->district_id);
        }
        
        $families = $query->with(['district'])->paginate(15);
        
        return view('families.index', compact('families'));
    }

    /**
     * Export families to CSV.
     */
    public function exportCsv()
    {
        $user = Auth::user();
        
        $families = Family::when(!$user->hasRole('admin'), function ($query) use ($user) {
            return $query->where('district_id', $user->district_id);
        })
        ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="families_export_' . now()->format('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($families) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'ID',
                'Primary Contact Name',
                'Student Names',
                'Outstanding Balance',
                'Email',
                'Phone',
                'Address',
                'City',
                'State',
                'ZIP',
                'Notes',
                'Account Number',
                'Recovery Status',
                'Collection Status',
                'Created At'
            ]);

            foreach ($families as $family) {
                fputcsv($file, [
                    $family->id,
                    $family->primary_contact_name,
                    $family->student_names,
                    $family->outstanding_balance,
                    $family->email,
                    $family->phone,
                    $family->address,
                    $family->city,
                    $family->state,
                    $family->zip,
                    $family->notes,
                    $family->account_number,
                    $family->recovery_status,
                    $family->collection_status,
                    $family->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get district debt capacity.
     */
    public function getCapacity()
    {
        $user = Auth::user();
        $district = $user->district;
        
        if (!$district || !$district->subscription) {
            return response()->json(['capacity' => 0, 'used' => 0, 'remaining' => 0]);
        }

        $subscription = $district->subscription;
        $tier = $subscription->tier;

        // Define capacity based on tier
        $capacities = [
            'free' => 0,
            'standard' => 10000, // $10k
            'enterprise' => 100000, // $100k
        ];

        $capacity = $capacities[$tier] ?? 0;

        // Calculate used capacity (sum of all family balances in the district)
        $used = $district->families()->sum('outstanding_balance');

        return response()->json([
            'capacity' => $capacity,
            'used' => $used,
            'remaining' => $capacity - $used,
            'utilization_percentage' => $capacity > 0 ? round(($used / $capacity) * 100, 2) : 0
        ]);
    }
}
