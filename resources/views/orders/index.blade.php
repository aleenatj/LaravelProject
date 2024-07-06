@extends('layouts.app')

@section('page-title', 'Orders')

@section('content')
    <div class="container-flex">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
            <div class="col-md">
            <a href="{{route('admin.dashboard')}}" class="btn btn-dark">Back</a>
            </div>
                <a href="{{route('product.create')}}" class="btn btn-dark">Create</a>
            </div>
        
       
            @if(Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                {{Session::get('success')}}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card borde-0 shadow-1g my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Orders</h3>
                    </div>  
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                             <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Customer_id</th>
        <th>Address</th>
        <th>quantity</th>
        <th>total_amount</th>
        <th>Created_at</th>
        <th>Status</th>
        <th>Gift_card_used</th>
        <th>Details</th>
        <!-- Add more columns as needed -->
    </tr>
    @foreach($orders as $order)
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->customer_id }}</td>
        <td>{{$order->customer_address}}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->total_amount }}</td>
        <td>{{$order->created_at}}</td>
        <td><form action="{{ route('order.status', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <select name="status" onchange="this.form.submit()">
                    <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                    <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Cancelled" {{ $order->status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
</a></td>
<td>{{$order->gift_cards_used}}</td>
        <td>
        <a class="btn btn-dark" href="{{ route('order.downloadPdf', ['orderId' => $order->id]) }}">Details</a>
        </td>
    </tr>
    @endforeach

                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

@endsection
