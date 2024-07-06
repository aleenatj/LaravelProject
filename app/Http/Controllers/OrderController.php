<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        // Retrieve all orders from the database
        $orders = Orders::all(); // Assuming you have an Order model
    
        // Pass the orders data to the view for display
        return view('orders.index', compact('orders'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|integer|min:1',
        ]);
    
        DB::transaction(function () use ($request) {
            // Create a new Order instance
            $order = new Orders();
            $order->customer_name = $request->input('customer_name');
            $order->status = $request->input('status');
            $order->save(); 
    
            // Add products to order_items table
            foreach ($request->products as $product) {
                $product = Product::find($product['product_id']);
    
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'product_name' => $product->name,
                    'qty' => $product['quantity'],
                    'price' => $product->price,
                ]);
            }
          
        });
    
        return redirect()->back()->with('success', 'Order saved successfully!');
    }
    
    public function status(Request $request, $orderId)
{
    // Validate status field
    $request->validate([
        'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
    ]);

    try {
        // Find the order by ID
        $order = Orders::findOrFail($orderId);

        // Update order status
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update order status: ' . $e->getMessage());
    }
}
    public function orderDetails($orderId){
        $order = Orders::find($orderId);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
       
    if (!$order) {
        return redirect()->back()->with('error', 'Order not found.');
    }
    
    return view('orders.details', compact('order','orderItems'));
    }

    
}    
