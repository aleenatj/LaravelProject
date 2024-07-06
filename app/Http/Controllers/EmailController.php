<?php

namespace App\Http\Controllers;

use App\Mail\OrderCardConfirmationMail;
use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\GiftCard;
use App\Models\OrderCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Orders;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $orderId = $request->input('order_id');
        
        // Retrieve the order from the database
        $order = Orders::find($orderId);
        
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Retrieve order items
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        
        // Ensure there's at least one order item
        if ($orderItems->isEmpty()) {
            return redirect()->back()->with('error', 'No items found in this order.');
        }

        // Retrieve customer ID from the order
        $customerId = $order->customer_id;
        
        // Fetch gift cards for the customer
        $orderCards = OrderCard::where('customer_id', $customerId)->get();
        Log::info("Previous Product: " . json_encode($orderCards));

        $giftCards = GiftCard::where('customer_id', $customerId)->get();
        // Check if gift cards exist for the customer
        if ($giftCards->isEmpty()) {
            Log::info("No gift cards found for customer ID: {$customerId}");
        }

        $toEmail = $request->input('email');
        
        $orderCardRecipients = [];
        
        // Fetch order cards associated with the customer and order
        $orderCards = OrderCard::where('customer_id', $customerId)
                               ->where('order_id', $orderId)
                               ->get();
        
        // Log and collect order card recipients
        foreach ($orderCards as $orderCard) {
            $orderCardRecipients[$orderCard->to_mail] = $orderCard;
            Log::info("Gift card recipient added: {$orderCard->to_mail}");
        }
        

        foreach ($orderCardRecipients as $recipientEmail => $orderCard) {
            Mail::to($recipientEmail)->send(new OrderCardConfirmationMail($orderCard));
        }

        // Send the order confirmation email
        Mail::to($toEmail)->send(new OrderConfirmationMail($order, $orderItems));
        
        // Delete the gift cards for the customer
        GiftCard::where('customer_id', $customerId)->delete();
        
        return redirect()->route('front.successPage');
    }

}
