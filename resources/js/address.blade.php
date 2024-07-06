<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{(asset('front-assets/css/address.css'))}}">
    <!-- Custom CSS -->
    <style>
    
    </style>
</head>
<body>
    <div class="container-fluid" id="cart_top">
    <div class="container" >
        <div class="row justify-content-between mb-3">
            <div class="col-auto">
                
                <button type="button" class="btn btn-link" style="color: white;" onclick="window.history.back();">Back</button>
            </div>
            <div class="col-auto">
                <a href="{{route('front.home')}}" class="btn btn-link" style="color: white;">Continue Shopping</a>
    </div>
        </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
            @if(Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                {{Session::get('success')}}
                </div>
            </div>
            @endif
                <div class="address-container">
                    <h2>Enter Address Details</h2>
                    <form>
                        <div class="form-group">
                            <label for="inputFullName">Full Name</label>
                            <input type="text" class="form-control" id="inputFullName" placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address Line 1</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address Line 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputCity">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">State</label>
                                <select id="inputState" class="form-control">
                                    <option selected>New South Wales.</option>
                                    <option>Victoria.</option>
                                    <option>Queensland</option>
                                    <!-- Add your state options here -->
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">PinCode</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLandmark">Landmark</label>
                            <input type="text" class="form-control" id="inputLandmark" placeholder="Nearby landmark">
                        </div>
                        <div class="form-group">
                            <label for="inputPhoneNumber">Mobile Number</label>
                            <input type="tel" class="form-control" id="inputPhoneNumber" placeholder="Enter your phone number">
                        </div>
                        <form method="post" action="{{route('front.address.store')}}">
                            @csrf
                        <button type="submit" class="btn btn-block" style="color:white; background-color:rgb(224, 70, 9) ;">Continue to Payment</button>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid" id="footer">
        <div class="container">
        <div class="row">
            <div class="col-sm-3" >
                <p><b class="col1">CONTACT INFORMATION</b></p>
                <img src="{{(asset('front-assets/images/loc.png'))}}" class="image1">
                <div class="d1">
                <small><b class="col1">Approved Companies</b></small><br>
                <small>Rosenkranzer Str.2b<br>25927 Aventoft</small>
                </div><br>
                <img src="{{(asset('front-assets/images/mob.png'))}}" class="image2">
                <div class="d2">
                <small><b class="col1">Phone</b></small><br>
                <small>+45 3699 7080</small><br>
                <small>+49 4664 2830428</small><br>
                </div>
                <img src="{{(asset('front-assets/images/email.png'))}}" class="image3">
                <div class="d3">
                    <small><b class="col1">Email</b></small><br>
                    <small>cs@only-approved.com</small>
                </div>
            </div>
            <div class="col-sm-2" id="sm2">
                <p><b class="col1">USER LINKS</b></p>
                <div class="div1">
                <small>About Us</small><br>
                <small>Contact Ua</small><br>
                <small>My Account</small><br>
                <small>Order History</small><br>
                <small>Login</small>
                </div>
            </div>
            <div class="col-sm-2" id="sm3">
                <p><b class="col1">GENERAL INFORMATION</b></p>
                <div class="div2">
                <small>Privacy Policy</small><br>
                <small>Terms & Conditions</small><br>
                <small>Bodybuilding Blog</small><br>
                <small>Free Shipping</small><br>
                <small>Delivery</small>
                </div>
            </div>
            <div class="col-sm-2" id="sm4">
                <p><b class="col1">QUICK LINKS</b></p>
                <div class="div3">
                <small>Buy Whey Protein</small><br>
                <small>Buy fat Burners</small><br>
                <small>Buy Pre Workouts</small><br>
                <small>Buy Vitamins & Minerals</small><br>
                <small>Buy EAA & BCAA</small><br>
                <small>Buy Gym Clothing</small>
                </div>
            </div>
            <div class="col-sm-3">
                <p><b class="col1">FOLLOW US</b></p>
                <img src="{{(asset('front-assets/images/face.png'))}}">
                <img src="{{(asset('front-assets/images/insta.png'))}}">
                <img src="{{(asset('front-assets/images/you.png'))}}">
                <img src="{{(asset('front-assets/images/link.png'))}}">
            </div>
            
        </div>
        </div>
        <hr>
        <div class="container-fluid" id="fluid">
            <div class="container">
            <div class="row">
            <div class="col-sm-3">
                <small><b class="col1">Support Hours</b></small><br>
                <small>Mon-Fri /9:00-2:00PM</small>
            </div>
            <div class="col-sm-6">
                <small>&copy;Est.2021 Approved Companies GmbH,All Rights Reserved.</small><br>
                <small>Approved Companies</small>
            </div>
            <div class="col-sm-3">
                <img src="{{(asset('front-assets/images/pay.png'))}}">
    
            </div>
            </div>
            </div>
        </div>
    </div>
    <div class="footer2">
        <div class="acc">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" style="background-color: black; color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            CONTACT INFORMATION
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" style="background-color: black; color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            USER LINKS
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" style="background-color: black; color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            GENERAL INFORMATION
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button style="background-color: black; color: white;" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            QUICK LINKS
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the fourth item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" style="background-color: black; color: white;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                            FOLLOW US
                        </button>
                    </h2>
                    <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the fifth item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="f2details">
            <p class="f2txt">
                <span class="f2head">Support Hours</span> <br>
                Mon-fri/09:00AM-02:00PM <br>
                <img src="{{(asset('front-assets/images/pay.png'))}}" alt=""> <br>
                Est. 2021 Approved Companies GmbH, All Rights Reserved,<br>
            Approved Companies


            </p>
        </div>

    </div> 
 
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
