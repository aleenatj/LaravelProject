<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Summary</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table-responsive {
            margin-bottom: 30px;
        }
        .btn-proceed {
            background-color: rgb(224, 70, 9);
            border-color: rgb(224, 70, 9);
        }
        .btn-proceed:hover {
            background-color: #23272b;
            border-color: #23272b;
        }
        .payment-options {
            margin-top: 20px;
            display: none;
        }
        .red{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        @if(Session::has('error'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            </div>
        @endif

        <h1>Cart Summary</h1>

        <!-- Display items in the cart -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through cart items -->
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->name }}</td>
                            <td>
                                <img width="50" src="{{ asset('uploads/products/' . $cartItem->image) }}">
                            </td>
                            <td>${{ $cartItem->price }}</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>${{ $cartItem->price * $cartItem->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Cart summary details -->
        @php
            $subtotal = 0;
            foreach ($cartItems as $cartItem) {
                $subtotal += $cartItem->price * $cartItem->quantity;
            }
            $total = $subtotal; // Initialize total with subtotal
            if (isset($giftCard)) {
                // Reduce total by gift card amount
                $total -= $giftCard['amount'];
                // Ensure total doesn't go below zero
                if ($total < 0) {
                    $total = 0;
                }
            }
        @endphp

        <!-- Display adjusted subtotal, shipping, and total -->
        <div class="d-flex justify-content-between pb-2">
            <div>Subtotal</div>
            <div>${{ number_format($subtotal, 2) }}</div>
        </div>
        @if(isset($giftCard))
            <div class="d-flex justify-content-between pb-2">
                <div>Gift Card Applied</div>
                <div class="red">-${{ number_format($giftCard['amount'], 2) }}</div>
            </div>
            <div class="d-flex justify-content-between pb-2">
                <div>Shipping</div>
                <div>$0</div>
            </div>
        @else
            <div class="d-flex justify-content-between pb-2">
                <div>Shipping</div>
                <div>${{ number_format($shipping, 2) }}</div>
            </div>
        @endif
        <div class="d-flex justify-content-between summery-end">
            <div>Total</div>
            <div>${{ number_format($total, 2) }}</div>
        </div>

        <!-- Adjusted button based on gift card presence -->
        @if(isset($giftCard))
            <form method="post" action="{{ route('front.success') }}">
                @csrf
                <input type="hidden" name="status" value="Pending">
                <input type="hidden" name="gift_card_id" value="{{ $giftCard->id }}">
                <input type="hidden" name="gift_card_code" value="{{ $giftCard->code }}">
                @if($total == 0)
                    <button type="submit" class="btn btn-dark btn-block btn-proceed">Buy with Gift Card</button>
                @endif
            </form>
            @if($total > 0)
                <button class="btn btn-dark btn-block btn-proceed" data-toggle="modal" data-target="#paymentModal">Proceed to pay</button>
            @endif
        @else
            @if($total > 0)
                <button class="btn btn-dark btn-block btn-proceed" data-toggle="modal" data-target="#paymentModal">Proceed to pay</button>
            @endif
        @endif

        <!-- Payment Modal -->
        @if($total > 0)
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentModalLabel">Enter Payment Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('front.success') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="holderName">Cardholder Name</label>
                                    <input type="text" class="form-control" name="name" id="holderName" placeholder="Enter cardholder name">
                                </div>
                                <div class="form-group">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" class="form-control" name="card_number" id="cardNumber" placeholder="Enter card number">
                                </div>
                                <div class="form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Enter CVV">
                                </div>
                                <div class="form-group">
                                    <label for="expiryDate">Expiry Date</label>
                                    <input type="text" class="form-control" name="expiry_date" id="expiryDate" placeholder="MM/YYYY">
                                </div>
                                <input type="hidden" name="status" value="Pending">
                                @if(isset($giftCard))
                                    <input type="hidden" name="gift_card_id" value="{{ $giftCard->id }}">
                                    <input type="hidden" name="gift_card_code" value="{{ $giftCard->code }}">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-dark">Submit Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
