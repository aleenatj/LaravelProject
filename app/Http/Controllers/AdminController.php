<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        $totalOrders=Orders::where('status','!=','cancelled')->count();
        $totalProducts=Product::count();
        return view('admin.dashboard',[
            'totalOrders' =>$totalOrders,
            'totalProducts'=>$totalProducts
        ]);
    }

    public function store(){

    }
    public function showChangePasswordForm(){
        return view('admin.changepassword');
    }
    public function processChangePassword(Request $request){
          // Validate the request data
    $validateData = $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed',
    ]);

    // Get the authenticated admin 
    $user = Auth::guard('web')->user();
 // Debugging: Verify current password and hashed password
 
    // Check if the current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    // Update the user's password
    $user->password = Hash::make($request->password);
    $user->save();

    // Return a response, e.g., redirect to a specific page with a success message
    return redirect()->route('admin.showChangePasswordForm')->with('success', 'Password changed successfully!');

}
}