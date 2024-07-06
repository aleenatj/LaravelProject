<!doctype html>
@extends('layouts.app')

@section('page-title', 'Create Gift Card')

@section('content')
    <!-- <div class="bg-dark py-3">
        <h3 class="text-white text-center">Gift Card Details</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('admin.giftcard') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Add Gift Card</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('giftcard.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="code" class="form-label h5">Code</label>
                                <input value="{{ old('code') }}" type="text" class="@error('code') is-invalid @enderror form-control form-control-lg" placeholder="Code" name="code">
                                @error('code')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="from" class="form-label h5">From (optional)</label>
                                <input value="{{ old('from') }}" type="text" class="@error('from') is-invalid @enderror form-control form-control-lg" placeholder="From" name="from">
                                @error('from')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="to_mail" class="form-label h5">To Email (optional)</label>
                                <input value="{{ old('to_mail') }}" type="mail" class="@error('to_mail') is-invalid @enderror form-control form-control-lg" placeholder="To Email" name="to_mail">
                                @error('to_email')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label h5">Amount</label>
                                <input value="{{ old('amount') }}" type="text" class="@error('amount') is-invalid @enderror form-control form-control-lg" placeholder="Amount" name="amount">
                                @error('amount')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="expiry_date" class="form-label h5">Expiry Date</label>
                                <input value="{{ old('expiry_date') }}" type="date" class="@error('expiry_date') is-invalid @enderror form-control form-control-lg" placeholder="Expiry Date" name="expiry_date">
                                @error('expiry_date')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label h5">Status</label>
                                <select class="@error('status') is-invalid @enderror form-control form-control-lg" name="status">
                                    <option value="">Select Status</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                           
                            <div class="d-grid">
                                <button class="btn btn-lg btn-secondary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
@endsection
