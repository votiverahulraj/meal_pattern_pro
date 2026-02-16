<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            // Admin can see all subscriptions
            $subscriptions = Subscription::with(['district'])->paginate(15);
        } else {
            // Regular user can only see their own subscription
            $subscriptions = Subscription::where('district_id', $user->district_id)
                                        ->with(['district'])
                                        ->paginate(15);
        }

        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Subscription::class);
        
        $districts = District::all();
        return view('subscriptions.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'tier' => 'required|in:free,standard,enterprise',
            'status' => 'required|in:active,cancelled,past_due,trialing,paused',
            'amount' => 'required|numeric|min:0',
        ]);

        $subscription = Subscription::create([
            'district_id' => $request->district_id,
            'tier' => $request->tier,
            'status' => $request->status,
            'amount' => $request->amount,
            'current_period_start' => now(),
            'current_period_end' => now()->addMonth(),
        ]);

        return redirect()->route('subscriptions.show', $subscription->id)->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $this->authorize('view', $subscription);
        
        $subscription->load(['district']);
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        $this->authorize('update', $subscription);
        
        $districts = District::all();
        return view('subscriptions.edit', compact('subscription', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $this->authorize('update', $subscription);
        
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'tier' => 'required|in:free,standard,enterprise',
            'status' => 'required|in:active,cancelled,past_due,trialing,paused',
            'amount' => 'required|numeric|min:0',
        ]);

        $subscription->update([
            'district_id' => $request->district_id,
            'tier' => $request->tier,
            'status' => $request->status,
            'amount' => $request->amount,
        ]);

        return redirect()->route('subscriptions.show', $subscription->id)->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $this->authorize('delete', $subscription);
        
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully.');
    }

    /**
     * Show subscription management page for district users.
     */
    public function manage()
    {
        $user = Auth::user();
        $subscription = $user->district->subscription;

        return view('subscriptions.manage', compact('subscription'));
    }

    /**
     * Show subscribe page for district users.
     */
    public function subscribe()
    {
        $user = Auth::user();
        $currentSubscription = $user->district->subscription;

        return view('subscriptions.subscribe', compact('currentSubscription'));
    }

    /**
     * Cancel subscription.
     */
    public function cancel(Subscription $subscription)
    {
        $this->authorize('update', $subscription);
        
        $subscription->update([
            'status' => 'cancelled',
            'cancel_at_period_end' => true,
        ]);

        return redirect()->route('subscriptions.index')->with('success', 'Subscription cancelled successfully.');
    }

    /**
     * Get district debt capacity based on subscription tier.
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
