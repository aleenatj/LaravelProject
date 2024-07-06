<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.login');
    }

    public function authenticate(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validateData) {
           if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
              
                return redirect()->route('front.home');
            } else {
                return redirect()->route('customer.login')->with('error', 'Either useremail or password is incorrect');
            }
        } else {
            return redirect()->route('customer.login')->withInput()->with('error', 'Either useremail or password is incorrect');
        }
    }
    
   // CustomerController.php

public function login(Request $request){
    if (Auth::check()) {
        return redirect()->route('front.home');
    }
    
    $data = $request->input(); 
    $request->session()->put('email', $data['email']);
    
    return view('customer.login');
}

public function logout()
{
    Auth::logout();
    session()->forget('email');

    return redirect()->route('customer.login');
}


    public function register()
    {
        return view('customer.register');
    }

    public function processRegister(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);

        if ($validateData) {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->password = Hash::make($request->password); // Fix typo in $request->password
            $customer->save();

            return redirect()->route('customer.login')->with('success', 'You have registered successfully');
        } else {
            return redirect()->route('customer.register')->withInput()->withErrors($validateData);
        }
    }
    public function changePassword(Request $request)
{
    // Validate the input
    $validateData=$request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed',
    ]);

    // Get the authenticated customer
    $customer = auth()->guard('customer')->user();

    // Check if the current password matches
    if (!Hash::check($request->current_password, $customer->password)) {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
   
    // Update the customer's password
    $customer->password = Hash::make($request->password); // Fix typo in $request->password
            // $customer->save();
            

    // Redirect with success message
    return redirect()->route('front.account')->with('success', 'Password changed successfully.');
}
public function orderDetails()
{
    $orders = Orders::with('orderItems.product')->get();
    return view('front.orders', compact('orders'));
}


public function showOrders($orderId)
{
    // Fetch the order by ID and ensure it belongs to the logged-in customer
    $order = Orders::findOrFail($orderId);

    return view('front.orders', compact('order'));
}
}
