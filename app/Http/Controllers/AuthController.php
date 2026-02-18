<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function customregister(){
        return view("auth.customregister");
    }
    public function registerProcess(Request $request){
        $this->validate($request,[
            'name'=>'required|alpha',
            "email"=> "required|email|unique:users,email",
            "password"=> "required|min:6|confirmed",
            ]);
            $user = User::create([
                "name"=> $request->name,
                "email"=> $request->email,
                'password' => Hash::make($request->password)
                ]);
            $user->assignRole('district');
            return redirect()->route('dashboard')->with('success','Districts register Successfully');
    }

    public function Authenticated(Request $request){
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required|min:6',
            ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->hasRole('admin')){
                return redirect()->route('dashboard')->with('success','Super Admin login successfully');
            }
            else if(Auth::user()->hasRole('district')){
                return redirect()->route('dashboard')->with('success','District login successfully');
            }else{
                return redirect()->route('login')->with('error','UnAuthorized');
            }
        }
    }

    public function districtDashboard(){
        return view('district.dashboard');
    }
}
