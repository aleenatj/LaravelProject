@extends('layouts.front')

@section('page-title', 'Details')

@section('front')
<div class="container gift-card">
    <div class="row no-gutters">
        <div class="col-md-6">
            <img src="{{ asset('front-assets/images/giftcard.jpg') }}" class="card-img" alt="Gift Card Image">
        </div>
        <div class="col-md-6">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('giftcard.store.front') }}" method="POST">
                    @csrf
                    <input type="hidden" id="selected_amount" name="selected_amount" value="">
                    <div class="form-group">
                        <label for="from">From:</label>
                        <input type="text" class="form-control" id="from" name="from" required>
                    </div>
                    <div class="form-group">
                        <label for="to">To:</label>
                        <input type="email" class="form-control" id="to" name="to" required>
                    </div>
                    <h5 class="card-title">Choose Gift Card Amount</h5>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-secondary amount-btn" data-amount="25">$25</button>
                        <button type="button" class="btn btn-secondary amount-btn" data-amount="50">$50</button>
                        <button type="button" class="btn btn-secondary amount-btn" data-amount="75">$75</button>
                        <button type="button" class="btn btn-secondary amount-btn" data-amount="100">$100</button>
                    </div>
                    <div class="form-group mt-3">
                        <select class="form-control" id="amount" name="amount" required>
                            <option value="25">$25</option>
                            <option value="50">$50</option>
                            <option value="75">$75</option>
                            <option value="100">$100</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date">Delivery Date:</label>
                        <input type="date" class="form-control" id="delivery_date" name="delivery_date">
                    </div>
                    <button type="submit" class="addto">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" id="home">
    <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <img src="{{ asset('front-assets/images/home.png') }}" class="hai">
            </div>
            <div class="col-sm-3" id="home-3">
                <h5 class="hai">NEW SUBSCRIBER<br><b class="hai">DISCOUNT</b></h5>
            </div>
            <div class="col-sm-4">
                <h6 class="haii">Signup to our weekly newsletter and receive a<br><b><u id="u">12% discount code</u></b></h6>
            </div>
            <div class="col-sm-4">
                <input type="text" placeholder="Email Address" class="email">
                <span class="subscribe-text">Subscribe</span>
            </div>
        </div>
    </div>
</div>

<style>
    .amount-btn {
        margin-right: 10px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle click on amount buttons
        const amountButtons = document.querySelectorAll('.amount-btn');
        amountButtons.forEach(button => {
            button.addEventListener('click', function () {
                const selectedAmount = this.getAttribute('data-amount');
                document.getElementById('amount').value = selectedAmount;
                document.getElementById('selected_amount').value = selectedAmount;
            });
        });

        // Handle change in select amount
        const selectAmount = document.getElementById('amount');
        selectAmount.addEventListener('change', function () {
            const selectedAmount = this.value;
            document.getElementById('selected_amount').value = selectedAmount;
        });
    });
</script>
@endsection
