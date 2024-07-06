@extends('layouts.front')

@section('page-title', 'home')

@section('front')
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: Arial, sans-serif; /* Choose your preferred font */
        }
        .breadcrumb {
            background-color: #e9ecef; /* Light gray breadcrumb background */
            border-radius: 0; /* Remove border-radius */
        }
        .breadcrumb-item.active {
            font-weight: bold; /* Bold active breadcrumb item */
        }
        .card {
            border: none; /* Remove card border */
            border-radius: 0; /* Remove card border-radius */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Subtle card shadow */
        }
        .card-header {
            background-color: rgb(224, 70, 9); /* Primary color header background */
            color: white; /* White header text */
            border-bottom: 2px solid #0056b3; /* Darker border bottom */
        }
        .card-header h5 {
            margin-bottom: 0; /* Remove margin bottom from header */
        }
        .card-body {
            padding: 30px; /* Increased padding for body */
        }
        .user-details {
            background-color: white; /* White background for user details */
            padding: 20px; /* Padding inside user details */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Subtle box shadow */
        }
        .user-details h4 {
            margin-top: 0; /* Remove margin top for user name */
        }
        .user-details p {
            margin-bottom: 10px; /* Add margin bottom for paragraphs */
        }
        .user-image {
            text-align: center; /* Center user image */
        }
        .user-image img {
            border-radius: 50%; /* Circular user image */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Subtle box shadow */
        }
        .options-list {
            list-style: none; /* Remove list styles */
            padding-left: 0; /* Remove default list padding */
        }
        .options-list li {
            margin-bottom: 10px; /* Add margin bottom for list items */
        }
        .options-list a {
            color: #007bff; /* Primary link color */
            text-decoration: none; /* Remove underline */
            transition: color 0.3s; /* Smooth color transition */
        }
        .options-list a:hover {
            color: #0056b3; /* Darker color on hover */
        }
        .logout-btn {
            background-color: #dc3545; /* Danger color for logout button */
            border: none; /* Remove border */
        }
        .logout-btn:hover {
            background-color: #c82333; /* Darker color on hover */
        }
        #color-button{
            color: white;
    
    background-color: rgb(224, 70, 9);
}
    </style>
  

    <!-- Section 9: Account Details -->
    <section class="section-9 pt-4">
        <div class="container">
            <!-- Display success message if present -->
            @if (session('success'))
            <div class="alert alert- alert-dismissible fade show" role="alert">
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

        

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Account Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 user-image">
                            <!-- User image -->
                            <img src="{{ asset('front-assets/images/profile.jpeg') }}" alt="User Image" class="img-fluid mb-3" style="width: 100px; height: 100px;">
                        
                        </div>
                        
                        <div class="col-md-9 user-details">
                            <!-- User name -->
                            <h4>{{ $customer->name }}</h4>
                            <!-- User email -->
                            <p>Email: {{ $customer->email }}</p>
                            <!-- User address, etc. -->
                            @if ($customerAddress)
                                <p>Address: {{ $customerAddress }}</p>
                            @else
                                <p>No address found.</p>
                            @endif

                            <!-- Buttons for Orders and Change Password -->
                            <div class="mt-4">
                            <a href="{{ route('customer.logout') }}" class="btn btn- " id="color-button">Logout</a>
                            <a href="{{ route('customer.orders') }}" class="btn btn-primary">Order Details</a>
                            <button type="button" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#changePasswordModal">
                                    Change Password
                                </button>
                            </div>

                            <!-- Logout option -->
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('customer.change-password.post') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<br><br>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Add your custom JavaScript here -->
@endsection