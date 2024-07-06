<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\GiftCard;
use App\Models\OrderCard;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GiftCardController extends Controller
{
    public function giftcard($id){
        $customer = Auth::guard('customer')->user();
        $categories = Category::whereNull('parent_id')->with('children')->get();
        $products = DB::table('product')->find($id);
        return view('front.giftcard',[
            'customer' => $customer,
            'categories'=>$categories,
            'products'=>$products
        ]);
    }
    public function index(){
        $giftcards =GiftCard::orderBy('created_at', 'DESC')->get();
        return view('admin.giftcard.index',[
            'giftcards'=>$giftcards
        ]);
    }
    public function create(){
        return view('admin.giftcard.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'selected_amount' => 'required|numeric|min:1',
            'from' => 'required|string',
            'to' => 'required|email',
            'description' => 'nullable|string',
            'delivery_date' => 'nullable|date',
        ]);
    
        // Generate a unique code for the gift card
        $uniqueCode = Str::random(8);
        while (GiftCard::where('code', $uniqueCode)->exists()) {
            $uniqueCode = Str::random(8);
        }
    
        // Find the product for the gift card
        $product = Product::where('name', 'Gift Card')->first();
        $customerId = Auth::guard('customer')->id();
        $productType = $product->name === 'gift card' ? 'gift_card' : 'regular';
    
        // Create a new gift card
        $giftCard = new GiftCard();
        $giftCard->code = $uniqueCode;
        $giftCard->customer_id=$customerId;
        $giftCard->from = $validatedData['from'];
        $giftCard->to_mail = $validatedData['to'];
        $giftCard->amount = $validatedData['selected_amount'];
        $giftCard->balance = $validatedData['selected_amount'];
        $giftCard->expiry_date = Carbon::now()->addDays(7); // Default expiry date to 7 days from now
        $giftCard->description = $validatedData['description'] ?? '';
        $giftCard->status = 'active'; // Assuming status is active by default
        $giftCard->save();

      
    
        // Create a cart item for the gift card
        Cart::create([
            'customer_id' => Auth::guard('customer')->id(),
            'gift_card_id' => $giftCard->id,
            'product_id' => $product->id,
            'image' => $product->image,
            'name' => $product->name, // or $giftCard->code
            'price' => $giftCard->amount,
            'product_type'=>$productType,
            'quantity' =>1,
        ]);
    
        return redirect()->route('front.cart')->with('success', 'Gift Card added to cart successfully');
    }
    public function view(){
        return view('email.gift_card_confirmation');
    }
    public function checkGiftCard(Request $request)
    {
        $code = $request->input('code');
     

        // Find the gift card by code
        $giftCard = OrderCard::where('code', $code)->first();

        if ($giftCard) {
            // If gift card is found and valid
            return response()->json(['success' => true, 'message' => 'Gift card applied successfully!', 'amount' => $giftCard->amount]);
        } else {
            // If gift card is not found or invalid
            return response()->json(['success' => false, 'message' => 'Invalid gift card code.']);
        }
    }
    public function updateGiftCard(Request $request)
{
    $code = $request->input('code');
    $remainingBalance = $request->input('remaining_balance');

    // Find the gift card by code
    $giftCard = OrderCard::where('code', $code)->first();

    if ($giftCard) {
        // Update the remaining balance
        $giftCard->balance = $remainingBalance;
        $giftCard->save();

        return response()->json(['success' => true, 'message' => 'Gift card balance updated successfully.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Gift card not found.']);
    }
}

    
}
