<!doctype html>
@extends('layouts.app')

@section('page-title', 'Change Password')

@section('content')
   
    <div class="container">
        <div class="row justify-content-center mt-4">
        @if (session('success'))
        <div class="alert alert-success">
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
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Change Password</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.processChangePassword') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="current_password" class="form-label h5">Current Password</label>
                                <input type="password" id="current_password" class="form-control form-control-lg @error('current_password') is-invalid @enderror" placeholder="Current Password" name="current_password">
                                @error('old_password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label h5">New Password</label>
                                <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="New Password" name="password">
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label h5">Confirm Password</label>
                                <input type="password" id="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation">
                                @error('password_confirmation')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg btn-secondary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
