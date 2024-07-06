@extends('layouts.front')

@section('page-title', 'home')

@section('front')
 

    <section class="section-5 pt-3 pb-3 mb-3" id="order_top">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('front.account') }}">Account</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @foreach($orders as $order)
                <div class="card mt-4">
                    <div class="card-header bg-dark text-white">
                        <h4>Order ID: {{ $order->id }}</h4>
                    </div>
                    <div class="card-body">
                        <p>Customer Name: {{ $order->customer_name }}</p>
                        <p>Customer Address: {{ $order->customer_address }}</p>
                        <p>Status: {{ $order->status }}</p>
                        <p>Total Amount: ${{ $order->total_amount }}</p>

                        <h5>Products:</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td><img src="{{ asset('uploads/products/'.$item->product->image) }}" alt="{{ $item->product->name }}" style="width: 50px;"></td>
                                    <td>{{ $item->qty }}</td>
                                    <td>${{ $item->price }}</td>
                                    <td>${{ $item->price * $item->qty }}</td>
                                    @if($order->status =='Delivered')
                                    <td>
                                        <a href="{{route('front.review')}}">write a review</a></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
