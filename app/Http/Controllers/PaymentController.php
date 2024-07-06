<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\GiftCard;
use App\Models\OrderCard;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $customerId = Auth::guard('customer')->id();
        $code = $request->input('code'); // Retrieve the gift card code from the request
        $address = $request->input('address'); // Retrieve the address from the request
        
        Log::info("Customer ID: " . $customerId); // Log the customer ID
        Log::info("Gift Card Code: " . $code); // Log the gift card code received from the request
        Log::info("Address: " . json_encode($address)); // Log the address details
        
        // Retrieve cart items for the authenticated customer
        $cartItems = Cart::where('customer_id', $customerId)->get(); 
        $subtotal = 0;
        $shipping = 20; // Assuming fixed shipping cost
        
        foreach ($cartItems as $cartItem) {
            $subtotal += $cartItem->price * $cartItem->quantity;
        }
        
        // Check if a gift card code is provided
        
            // Retrieve the gift card using the code
            $giftCard = OrderCard::where('code', $code)->first(); // Use first() to get a single instance
            
            Log::info("Gift Card Retrieved: " . json_encode($giftCard)); // Log the gift card details
            
            if ($giftCard) {
                $subtotal -= $giftCard->amount;
                $subtotal = max($subtotal, 0); // Ensure subtotal doesn't go below zero
            } else {
                Log::warning("Invalid gift card code: " . $code); // Log if the gift card code is invalid
            }
   
        // Calculate total amount including shipping
        $total = $subtotal + $shipping;
        
        return view('front.paay', compact('cartItems', 'subtotal', 'shipping', 'total', 'giftCard', 'address'));
    }
    
    

public function successpayment(Request $request)
{
    DB::beginTransaction(); // Start a database transaction
    try {
        $customerId = Auth::guard('customer')->id();

        // Retrieve customer with their address
        $customer = Customer::with('address')->find($customerId);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found.');
        }

        // Retrieve customer address
        $customerAddress = $customer->address ? 
            $customer->address->address1 . ', ' . $customer->address->address2 . ', ' . $customer->address->city . ', ' . $customer->address->state :
            null;

        // Retrieve payment details from the request
         // Fetch cart items to get quantity and subtotal
           // Retrieve customer address
        $customerAddress = $customer->address ? 
        $customer->address->address1 . ', ' . $customer->address->address2 . ', ' . $customer->address->city . ', ' . $customer->address->state :
        null;

    // Fetch cart items to get quantity and subtotal
    $cartItems = Cart::where('customer_id', $customerId)->with('product')->get();
    $totalQuantity = 0;
    $subtotal = 0;

    foreach ($cartItems as $cartItem) {
        $totalQuantity += $cartItem->quantity;
        $subtotal += $cartItem->price * $cartItem->quantity;
    }

    // Define shipping cost (you may need to adjust this value based on your logic)
    $shipping = 0;

    // Check if a gift card is applied
    $giftCardAmount = 0;
    $appliedGiftCards = OrderCard::where('customer_id', $customerId)->where('status', 'active')->get();
    if ($appliedGiftCards->isNotEmpty()) {
        foreach ($appliedGiftCards as $orderCard) {
            $giftCardAmount += $orderCard->amount;
        }
    }

    // Calculate total price
    $total = max(0, $subtotal - $giftCardAmount + $shipping); // Ensure total is not negative

       
        // Validate the status field for Orders
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled', // Define your status options for Orders
        ]);
        $order = new Orders();
        // Save order details
        $order->customer_id = $customerId;
        $order->customer_name = $customer->name; // Assuming 'name' is a field in customers table
        $order->customer_address = $customerAddress;
        $order->quantity = $totalQuantity;
        $order->total_amount = $total;
        $order->status = $request->input('status'); // Assign status from form input
        $giftCardsUsed = 'not_used'; // Flag to indicate if gift cards were used

        $appliedGiftCards = OrderCard::where('customer_id', $customerId)->where('status', 'active')->get();
        if ($appliedGiftCards->isNotEmpty()) {
            $giftCardsUsed = 'used';
        }

// Set the order attribute based on whether gift cards were used
        $order->gift_cards_used = $giftCardsUsed;
        $order->save();


 
        $product = Product::where('name', 'Gift Card')->first();
        foreach($cartItems as $cartItem){
            $orderitem=new OrderItem();
            $orderitem->order_id=$order->id;
            $orderitem->product_id=$cartItem->product_id;    
            $orderitem->product_name=$cartItem->name;
            $orderitem->qty=$cartItem->quantity;
            $orderitem->price=$cartItem->price;
            $product = Product::find($cartItem->product_id);
            $productType = $product->name === 'gift card' ? 'gift_card' : 'regular';
            $orderitem->product_type = $productType;
            
            $orderitem->save();
            
        }
        $giftCards=GiftCard::where('customer_id',$customerId)->get();
        Log::info("Previous Product: " . json_encode($giftCards));
        if ($giftCards->isEmpty()) {
            Log::info("No gift cards found for customer ID: {$customerId}");
        } else {
            foreach ($giftCards as $giftCard) {
                $orderCard = new OrderCard();
                $orderCard->order_id = $order->id; // Assign the order_id passed to this method
                $orderCard->customer_id = $customerId;
                $orderCard->code = $giftCard->code;
                $orderCard->from = $giftCard->from;
                $orderCard->to_mail = $giftCard->to_mail;
                $orderCard->amount = $giftCard->amount;
                $orderCard->expiry_date = $giftCard->expiry_date;
                $orderCard->status = $giftCard->status;
                $orderCard->description = $giftCard->description;
                $orderCard->save();
            }
        }
        if ($giftCardsUsed === 'used') {
            foreach ($appliedGiftCards as $orderCard) {
                $orderCard->status = 'used';
                $orderCard->save();

                // Optionally, you can also delete the OrderCard associated with the gift card
                $orderCard->delete();
                Log::info('code is delete successfully ' . $orderCard->code);   

            }
        }
        Log::info('Order confirmation email sent to ' . $customer->email);   

        DB::commit(); // Commit the transaction

        // Redirect to success page with a success message
        return redirect()->route('send.email', ['order_id' => $order->id, 'email' => $customer->email]);
    } catch (\Exception $e) {
        DB::rollBack(); // Rollback the transaction if something went wrong
        Log::error('Failed to process payment: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Error processing payment: ' . $e->getMessage());
    }
}

}


