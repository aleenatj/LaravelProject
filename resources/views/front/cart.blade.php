@extends('layouts.front')

@section('page-title', 'Cart')

@section('front')

<section class="section-9 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>@if(isset($giftCard)) Amount @else Quantity @endif</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $cartItem)
                                <tr>
                                    <td>{{ $cartItem->name }}</td>
                                    <td><img width="50" src="{{ asset('uploads/products/' . $cartItem->image) }}"></td>
                                    <td>${{ $cartItem->price }}</td>
                                    <td>
                                        @if($cartItem->giftCard) {{-- Check if it's a gift card --}}
                                            ${{ $cartItem->giftCard->amount }}
                                        @else
                                            <div class="input-group quantity" style="max-width: 150px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-sm btn-dark btn-minus" type="button" data-product-id="{{ $cartItem->id }}">-</button>
                                                </div>
                                                <input type="number" class="form-control form-control-sm text-center border-0 quantity-input" value="{{ $cartItem->quantity }}" data-product-id="{{ $cartItem->id }}" data-price="{{ $cartItem->price }}">
                                                <div class="input-group-append">
                                                    <button class="btn btn-sm btn-dark btn-plus" type="button" data-product-id="{{ $cartItem->id }}">+</button>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="total-price" data-product-id="{{ $cartItem->id }}">${{ $cartItem->price * $cartItem->quantity }}</td>
                                    <td>
                                        <form action="{{ route('front.removeFromCart', $cartItem->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            {{-- Display Gift Card Details if available --}}
                            @if(isset($giftCard))
                                <tr>
                                    <td colspan="4"><strong>Gift Card Details</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>From:</strong> {{ $giftCard->from_name }}</td>
                                    <td colspan="3"><strong>To:</strong> {{ $giftCard->to_name }}</td>
                                    <td><strong>Amount:</strong> ${{ $giftCard->amount }}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>Description:</strong> {{ $giftCard->description }}</td>
                                </tr>
                                <tr>
                                    <td colspan="6"><strong>Delivery Date:</strong> {{ $giftCard->delivery_date }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card cart-summery">
                <div class="sub-title">
                    <h2 class="bg-white">Cart Summary</h2>
                </div>
                <div class="card-body">
                    @php
                        $subtotal = 0;
                        $shipping = 20; // Assuming fixed shipping cost
                    @endphp

                    @foreach($cartItems as $cartItem)
                        @php
                            if (isset($cartItem->giftCard)) {
                                $subtotal += $cartItem->giftCard->amount;
                            } else {
                                $subtotal += $cartItem->price * $cartItem->quantity;
                            }
                        @endphp
                    @endforeach

                    <div class="d-flex justify-content-between pb-2">
                        <div>Subtotal</div>
                        <div id="subtotal">${{ number_format($subtotal, 2) }}</div>
                    </div>
                    <div class="d-flex justify-content-between pb-2">
                        <div>Shipping</div>
                        <div id="shipping">${{ isset($giftCard) ? 0 : $shipping }}</div>
                    </div>
                    <div class="d-flex justify-content-between summery-end">
                        <div>Total</div>
                        <div id="total">${{ number_format($subtotal + (isset($giftCard) ? 0 : $shipping), 2) }}</div>
                    </div>
                    <div class="pt-5">
                        <form action="{{ route('front.address') }}" method="GET">
                            @csrf
                            <input type="hidden" name="code" value="{{ $giftCardCode ?? '' }}">
                            <button type="submit" class="btn-dark btn btn-block w-100">Enter Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group apply-coupan mt-4">
                <form action="{{ route('front.address') }}" method="GET">
                    @csrf
                    <input type="text" id="giftCardCode" name="code" placeholder="Enter code" class="form-control">
                    <button type="submit" class="btn btn-dark">Apply Gift Card</button>
                </form>
            </div>
            <div id="giftCardMessage" class="mt-2"></div>
        </div>
    </div>
</div>

<br><br>

@endsection
