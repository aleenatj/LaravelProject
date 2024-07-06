<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{asset('front-assets/css/style1.css')}}">
    <link rel="stylesheet" href="{{asset('front-assets/css/rating.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
         function toggleDropdown() {
            document.getElementById("dropdown-contentf").classList.toggle("show");
        }
        function selectOption(option, flagSrc) {
            document.getElementById("selected-optionf").innerText = option.toUpperCase();
            // Get references to elements
            const flagImage = document.getElementById('flag-image');
            // Set the src attribute of the flag image
            flagImage.src = flagSrc;
            toggleDropdown();
        }
       
    </script>
 
<script>
function sortProducts(sortBy) {
    console.log('Sorting by:', sortBy);

    let container1 = document.querySelector('.grid-1');
    let container2 = document.querySelector('.grid-2');

    if (!container1 || !container2) {
        console.error('One or both product containers not found!');
        return;
    }

    let products1 = Array.from(container1.querySelectorAll('.col'));
    let products2 = Array.from(container2.querySelectorAll('.col'));
    let products = [...products1, ...products2];
    console.log('Products found:', products);

    switch (sortBy) {
        case 'low-to-high':
            products.sort((a, b) => {
                let priceA = parseFloat(a.querySelector('.price').textContent.replace('$', ''));
                let priceB = parseFloat(b.querySelector('.price').textContent.replace('$', ''));
                return priceA - priceB;
            });
            break;
        case 'high-to-low':
            products.sort((a, b) => {
                let priceA = parseFloat(a.querySelector('.price').textContent.replace('$', ''));
                let priceB = parseFloat(b.querySelector('.price').textContent.replace('$', ''));
                return priceB - priceA;
            });
            break;
        default:
            // Default sorting (original order)
            break;
    }

    // Clear existing products
    container1.innerHTML = '';
    container2.innerHTML = '';

    // Append sorted products back to the containers
    products.slice(0, 5).forEach(product => {
        container1.appendChild(product);
    });
    products.slice(5).forEach(product => {
        container2.appendChild(product);
    });
}


   
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

    <script>
    function details(productId) {
        if(productId==11){
            window.location.href = '/home/giftcard/' + productId;
        }
        else
        // Redirect to another page (replace 'url' with the actual URL)
        window.location.href = '/addtocart/detail/' + productId;
    }
    function addToCart(id){
        alert(id);
    }
</script>
<script>
function sortProductsName(sortBy) {
    console.log('Sorting by:', sortBy);

    let container1 = document.querySelector('.row.product-grid.grid-1');
    let container2 = document.querySelector('.row.product-grid.grid-2');

    if (!container1 || !container2) {
        console.error('One or both product containers not found!');
        return;
    }

    let products1 = Array.from(container1.querySelectorAll('.col'));
    let products2 = Array.from(container2.querySelectorAll('.col'));
    let products = [...products1, ...products2];
    console.log('Products found:', products);

    products.forEach(product => {
        let productNameElement = product.querySelector('.bp2');
        if (!productNameElement) {
            console.error('Product name element not found for:', product);
        }
    });

    switch (sortBy) {
        case 'asc':
            products.sort((a, b) => {
                let nameA = a.querySelector('.bp2') ? a.querySelector('.bp2').textContent.trim() : '';
                let nameB = b.querySelector('.bp2') ? b.querySelector('.bp2').textContent.trim() : '';
                return nameA.localeCompare(nameB);
            });
            break;
        case 'desc':
            products.sort((a, b) => {
                let nameA = a.querySelector('.bp2') ? a.querySelector('.bp2').textContent.trim() : '';
                let nameB = b.querySelector('.bp2') ? b.querySelector('.bp2').textContent.trim() : '';
                return nameB.localeCompare(nameA);
            });
            break;
        default:
            // Default sorting (original order)
            break;
    }

    // Clear existing products
    container1.innerHTML = '';
    container2.innerHTML = '';

    // Append sorted products back to the containers
    products.slice(0, 5).forEach(product => {
        container1.appendChild(product);
    });
    products.slice(5).forEach(product => {
        container2.appendChild(product);
    });
}
</script>

      <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
    <div class="container-fluid">
    
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <img src="{{(asset('front-assets/images/first.png'))}}" class="first">
                    <h1 class="hov">=</h1>
                </div>
                <div class="col-sm">
                    <img src="{{(asset('front-assets/images/trust.png'))}}" class="head-trust">
                </div>
                <div class="col-sm" id="text">
                    <input type="text" class="head-text" placeholder="Search">
                    
                    <i class="fa fa-search" id="i"></i>
                    
                   
                </div>
                <div class="col-sm">
                    <img src="{{(asset('front-assets/images/logo.png'))}}" class="logo">
                </div>
                <div class="col-sm">
                    
                </div>
                <div class="col-sm">
                    <div class="language-select" style="display: flex;">
                        <div class="flag-container">
                            <img src="{{(asset('front-assets/images/country.png'))}}" id="flag-image" class="flag" alt="Flag">
                        </div>
                        <div class="custom-dropdownf" onclick="toggleDropdown()">
                            <!-- Replace the existing content inside the span tag with your desired symbol -->
                            <span id="selected-optionf">EN</span><img src="{{(asset('front-assets/images/drop.png'))}}" class="drop1">
                            <div class="dropdown-contentf" id="dropdown-contentf">
                                <a href="#" onclick="selectOption('en', 'country.png')">English</a>
                                <a href="#" onclick="selectOption('fr', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARMAAAC3CAMAAAAGjUrGAAAAFVBMVEX///8AJlTOESYAGU16gpXefILNABnwlnA6AAAA/klEQVR4nO3QSQ0AIAADsHH6l4yKPUhaCc2oWTs9586aOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHixIkTJ06cOHHy4ckD5KrN4eD2boIAAAAASUVORK5CYII=')">French</a>
                                <a href="#" onclick="selectOption('es', 'data:image/png;base64,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')">Spanish</a>
                                <!-- Add more options as needed -->
                            </div>
                        </div>
                    </div>
                </div>
         
                <div class="col-sm">
                <a href="{{ route('front.account') }}">
                    <img src="{{(asset('front-assets/images/account.png'))}}" class="account">
                </a>
                    <a href="{{ route('front.cart') }}">
                         <img src="{{ asset('front-assets/images/bag.png') }}" class="bag">
                     </a>

                <div class="vl">
                    
                </div>
                @if(Auth::guard('customer')->check())
    <small id="p4">{{ Auth::guard('customer')->user()->name }}</small>
@endif
                <span id="p2">Bag</span>
                </div>
                
            </div>
        </div>

                
        </div>
    </header>
    <div class="container-fluid" id="con2">
    <div class="container" id="con3">
    @foreach ($categories as $category)
        <a class="sup" href="{{ route('category.show', $category->id) }}">{{ $category->category_name }} <img src="{{ asset('front-assets/images/drop.png') }}" class="drop1"></a>
        <div id="menu1">
            <div class="container">
                <div class="row">
                @foreach ($category->children as $subcategory)
                    <div class="col-sm-3">
                        <br>
                        <a href="{{ route('category.show', $subcategory->id) }}">{{ $subcategory->category_name }}</a>

                    </div>
                    
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    
        <a class="s">OUTLET</a>
       
        <a class="s">OFFERS</a>
        <a class="s">NEWS!</a> 
       
    </div>


    <div class="over">
    <div class="container-fluid" id="con4">
        <div class="container">
            <div class="row">
                <div class="col-sm-4" id="p-1">
                    <img src="{{(asset('front-assets/images/i1.png'))}}" class="p-i">
                    <p class="p1"><b class="p1">MARKETING REFERENCE</b>,Quality of products,Value of money</p>
                </div>
                <div class="col-sm-4" id="p-2">
                    <img src="{{(asset('front-assets/images/i2.png'))}}" class="p-i">
                    <p class="p1"><b class="p1">FREE EU SHIPPING*</b> On All Orders Over 100&euro;</p>
                </div>
                <div class="col-sm-4" id="p-3">
                    <img src="{{(asset('front-assets/images/i3.png'))}}" class="p-i">
                    <p class="p1"><b class="p1">INTERNATIONAL SUPPORT</b> Experienced Staff,It's Our Hobby</p>
                </div>
            </div>
        </div>
    </div>

      @if(Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                {{Session::get('success')}}
                </div>
            </div>
            @endif
   @yield('front')
    
 
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

</div>
</div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#applyGiftCardForm').on('submit', function(event) {
        event.preventDefault();
        var giftCardCode = $('#giftCardCode').val();

        $.ajax({
            url: '{{ route("giftcard.check") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                code: giftCardCode,
                subtotal: parseFloat($('#subtotal').text().replace('$', ''))
            },
            success: function(data) {
                if (data.success) {
                    $('#giftCardMessage').text(data.message);
                    var subtotalElement = $('#subtotal');
                    var totalElement = $('#total');
                    var currentSubtotal = parseFloat(subtotalElement.text().replace('$', ''));
                    var currentTotal = parseFloat(totalElement.text().replace('$', ''));
                    var giftCardAmount = data.amount;

                    // Calculate new subtotal and total
                    var newSubtotal = Math.max(0, currentSubtotal - giftCardAmount);
                    var newTotal = Math.max(0, currentTotal - giftCardAmount);

                    // Update subtotal and total in the UI
                    subtotalElement.text('$' + newSubtotal.toFixed(2));
                    totalElement.text('$' + newTotal.toFixed(2));

                    // Store remaining balance in the order card if applicable
                    if (currentSubtotal > giftCardAmount) {
                        $.ajax({
                            url: '{{ route("giftcard.update") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                code: giftCardCode,
                                remaining_balance: currentSubtotal - giftCardAmount
                            },
                            success: function(data) {
                                if (data.success) {
                                    console.log('Gift card balance updated');
                                } else {
                                    console.error('Error updating gift card balance:', data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                } else {
                    $('#giftCardMessage').text(data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>
</body>
</html>