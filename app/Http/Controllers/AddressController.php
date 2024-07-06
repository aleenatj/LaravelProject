<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    public function address(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        $address = Address::where('customer_id', $customerId)->first();
        $code = $request->input('code'); // Retrieve the gift card code from the request
    
        // If the user already has an address, redirect to the payment page with the address and code
        if ($address) {
            Log::info("Gift Card Code: " . $code); // Log the gift card code received from the request
            return redirect()->route('front.payment', ['address' => $address, 'code' => $code]);
        }
    
        // Otherwise, show the address form
        return view('front.address', ['code' => $code]);
    }
    
    
    public function store(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        
        // Check if the customer already has an address
        $address = Address::where('customer_id', $customerId)->first();
        $code = $request->input('code'); // Retrieve the gift card code from the request

        // If the user already has an address, show the payment page
        if ($address) {
            return redirect()->route('front.payment', ['code' => $code]);
        }

        // Otherwise, validate and save the address details
        $validatedData = $request->validate([
            'name' => 'required',
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'mobileno' => 'required',
        ]);

        if ($validatedData) {
            // Create a new address instance
            $address = new Address();
            $address->customer_id = $customerId;
            $address->name = $request->input('name');
            $address->address1 = $request->input('address1');
            $address->address2 = $request->input('address2');
            $address->city = $request->input('city');
            $address->state = $request->input('state');
            $address->pincode = $request->input('pincode');
            $address->mobileno = $request->input('mobileno');
            $address->save();

            // Redirect to the payment page after saving the address
            return redirect()->route('front.payment', ['code' => $code])->with('success', 'Address added successfully');
        } else {
            // Handle validation failure, redirect back to the address form
            return redirect()->route('front.address', ['code' => $code])->with('error', 'Validation failed. Please check your input and try again.');
        }
    }

    public function addressValidate()
    {
        $userAddress = Auth::guard('customer')->user()->address;

        // If user already has an address, redirect to payment page
        if ($userAddress) {
            return redirect()->route('front.payment');
        }
    
        return view('front.address');
    }
}
