<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if ($validateData) {
            if (Auth::attempt(['name' => $request->name, 'password' => $request->password])) {
              
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('admin.login')->with('error', 'Either username or password is incorrect');
            }
        } else {
            return redirect()->route('admin.login')->withInput()->with('error', 'Either username or password is incorrect');
        }
    }
    public function login(Request $request){
        $data = $request->input(); 
        $request->session()->put('name', $data['name']);
        if(session()->has('name'))
            {
               return redirect()->route('admin.dashboard');
               echo"hai";
            }
            else
            echo"nooooo";
            session()->pull('name');
            return view('admin.login');
    }

    public function logout()
    {
        Auth::logout();
        if (session()->has('name')) {
            return redirect()->route('admin.dashboard');
            session()->pull('name');
        }
        return redirect()->route('admin.login');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function processRegister(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validateData) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password); // Fix typo in $request->password
            $user->role='admin';
            $user->save();

            return redirect()->route('admin.login')->with('success', 'You have registered successfully');
        } else {
            return redirect()->route('admin.register')->withInput()->withErrors($validateData);
        }
    }
}
