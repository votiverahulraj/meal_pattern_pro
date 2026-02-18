<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function userList()
    {
        $users = User::with('user_detail')
            ->role('user')
            ->orderBy('created_at','desc')
            ->where('status', 0)
            ->get();
        return view("user.list", compact("users"));
    }

    public function userDetails($id){
        $user = User::with('user_detail')->role('user')->find($id);
        return view('user.details', compact('user'));
    }
    public function userAdd()
    {
        return view("user.create");
    }

    public function userProcess(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([

            // ✅ Required Fields
            'name'       => 'required|regex:/^[A-Za-z]+(?:\s[A-Za-z]+)*$/|max:255',
            'email'      => 'required|email|max:255|unique:users,email',
            'mobile_no'  => 'required|digits:10',

            // ✅ Nullable Fields
            'address'             => 'nullable|string|max:255',
            'city'                => 'nullable|string|max:255',
            'state'               => 'nullable|string|max:255',
            'pincode'             => 'nullable|digits_between:4,10',
            'jobtitle'            => 'nullable|string|max:255',

            'federal_programs'   => 'nullable|array',

            'student_enrollment'  => 'nullable|string|max:255',
            'meals_per_day'       => 'nullable|string|max:255',

            'building_served'     => 'nullable|integer|min:0',
            'annual_budget'       => 'nullable|string|max:255',

            'us_food'             => 'nullable|string|max:255',
            'software_provider'   => 'nullable|string|max:255',

            'monthly_hours_search' => 'nullable|integer|min:0',

            'collection_method'   => 'nullable',

            'commodity_diverted'  => 'nullable|integer|min:0',

            'trans_fat'           => 'nullable|string|max:255',
        ]);


        DB::beginTransaction();

        try {

            // ✅ Create User
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make(Str::random(10)), // Random password
            ]);
            $user->assignRole('user');

            // ✅ Create User Detail
            UserDetail::create([
                'user_id'             => $user->id,
                'name'                => $request->name,
                'email'               => $request->email,
                'phone'               => $request->mobile_no,
                'address'             => $request->address,
                'state'               => $request->state,
                'city'                => $request->city,
                'pincode'             => $request->pincode,
                'job_title'           => $request->jobtitle,
                'federal_programs'    => $request->federal_programs,
                'student_enrollment'  => $request->student_enrollment,
                'meal_per_day'        => $request->meals_per_day,
                'annual_budget'       => $request->annual_budget,
                'main_distributor'    => $request->us_food,
                'building_served'     => $request->building_served,
                'software_provider'   => $request->software_provider,
                'monthly_hours'       => $request->monthly_hours_search,
                'collection_method'   => $request->collection_method,
                'commodity_diverted'  => $request->commodity_diverted,
                'foodcoop_member'     => $request->trans_fat,
            ]);

            DB::commit();

            return redirect()->route('user.list')->with('success','User Created Successfully');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function userEdit($id){
        $useredit = User::with('user_detail')->role('user')->find($id);
        if($useredit){
            return view('user.update', compact('useredit'));
        }else{
            return back()->with('error','User Id Not Found');
        }
    }

public function userUpdate(Request $request, $id)
{
    $user = User::with('user_detail')
                ->where('id', $id)
                ->role('user')
                ->firstOrFail();

    // ✅ Validation (email unique ignore current user)
    $validated = $request->validate([

        'name'       => 'required|string|max:255',
        'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
        'mobile_no'  => 'required|digits:10',

        'address'             => 'nullable|string|max:255',
        'city'                => 'nullable|string|max:255',
        'state'               => 'nullable|string|max:255',
        'pincode'             => 'nullable|digits_between:4,10',
        'jobtitle'            => 'nullable|string|max:255',

        'federal_programs'    => 'nullable|array',

        'student_enrollment'  => 'nullable|string|max:255',
        'meals_per_day'       => 'nullable|string|max:255',

        'building_served'     => 'nullable|integer|min:0',
        'annual_budget'       => 'nullable|string|max:255',

        'us_food'             => 'nullable|string|max:255',
        'software_provider'   => 'nullable|string|max:255',

        'monthly_hours_search' => 'nullable|integer|min:0',

        'collection_method'   => 'nullable|array',

        'commodity_diverted'  => 'nullable|integer|min:0',

        'trans_fat'           => 'nullable|string|max:255',
    ]);

    DB::beginTransaction();

    try {

        // ✅ Update User
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // ✅ Update or Create User Detail
        $user->user_detail()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'name'                => $request->name,
                'email'               => $request->email,
                'phone'               => $request->mobile_no,
                'address'             => $request->address,
                'state'               => $request->state,
                'city'                => $request->city,
                'pincode'             => $request->pincode,
                'job_title'           => $request->jobtitle,
                'federal_programs'    => $request->federal_programs,
                'student_enrollment'  => $request->student_enrollment,
                'meal_per_day'        => $request->meals_per_day,
                'annual_budget'       => $request->annual_budget,
                'main_distributor'    => $request->us_food,
                'building_served'     => $request->building_served,
                'software_provider'   => $request->software_provider,
                'monthly_hours'       => $request->monthly_hours_search,
                'collection_method'   => $request->collection_method,
                'commodity_diverted'  => $request->commodity_diverted,
                'foodcoop_member'     => $request->trans_fat,
            ]
        );

        DB::commit();

        return redirect()->route('user.list')
                         ->with('success', 'User Updated Successfully');

    } catch (\Exception $e) {

        DB::rollBack();
        return back()->with('error', $e->getMessage());
    }
}


    public function userDelete($id){
       $userdelete = User::role('user')->findOrFail($id);
       if($userdelete){
        $userdelete->status = 1;
        $userdelete->save();
        return redirect()->route('user.list')->with('success','User Deleted Successfully');
       }else{
        return back()->with('error','User Id Not Found');
       }
    }
}
