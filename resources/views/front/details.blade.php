@extends('layouts.front')

@section('page-title', 'details')

@section('front')

   
        <div class="container">
            <div class="row">
          
                <div class="col-sm-6" id="bottle-big">
                    <br>
                    <img src="{{ asset('uploads/products/' . $products->image) }}" width="70%" height="70%">

                </div>
                <div class="col-sm-6" id="part2">
                    <div id>
                    <h4>{{$products->name}}</h4><br>
                     <div class="star-rating mt-2" title="70%">
                                            <div class="back-stars">
                                                <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                                                <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                                                <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                                                <i class="fa fa-star"  class="back-stars" aria-hidden="true"></i>
                                                <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                                                
                                                <div class="front-stars" style="width: {{$avgRatingPer}}%">
                                                    <i class="fa fa-star"aria-hidden="true"></i>
                                                    <i class="fa fa-star"aria-hidden="true"></i>
                                                    <i class="fa fa-star"   aria-hidden="true"></i>
                                                    <i class="fa fa-star"  aria-hidden="true"></i>
                                                    <i class="fa fa-star"  aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>  
                    <div class="vl-1"><p>({{$products->product_ratings_count>1?$products->product_ratings_count.'Reviews'
                                     :$products->product_ratings_count.'Review'}} )</p>
                    
                    </div>

                    <h6>{{$products->description}}</h6>
                    <hr class="hrs"><br>
                    <span>Availability: <b class="stock">In Stock</b></span>
                    <br>
                    <p class="euro">&euro;{{$products->price}}</p>
                    <hr class="hrs">
                    </div>
                    <b>FLAVOUR  </b>
                    <select class="select" >
                        <option  value="" disabled selected >Select an option   </option>
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                      </select>
                      <br>
                      <div class="quantity-selector">
                        <button onclick="decreaseQuantity()" class="quantity-">-</button>
                        <input type="number" id="quantity" class="quantity-input" value="1" min="1">
                        <button onclick="increaseQuantity()" class="quantityp">+</button>
                        <form action="{{ route('front.addToCart', ['id' => $products->id]) }}" method="POST">
                         @csrf
                        <button type="submit" class="addto">Add to Cart</button>
                        </form>


                      </div>     
                </div>
            </div>
         
        </div><br>
        <div class="container">
            <div class="row">
          
                
                  <div class="col" id="im2">
                    <div class="img-container1" >
                      <img src="{{(asset('front-assets/images/bottle-2.png'))}}" alt="Image 2" >
                      
                    </div>
                  </div>
                  <div class="col" id="image0">
                    <div class="img-container1" id="im-bot"><br>
                      <img src="{{(asset('front-assets/images/bottle-3.png'))}}" alt="Image 3" class="im3">
                      
                    </div>
                  </div>
                  <div class="col" id="im">
                    <div class="img-container1" >
                      <br><br><br><br><br>
                      
                    </div>
                  </div>
                  <div class="col" id="im1">
                    <div class="img-container1"  >
                       <br><br><br><br><br>
    
                    </div>
                  </div>
               
                    <div class="col-sm-6">
                   
                    </div>
               
                    </div>
        </div><br><br>
        <div class="container" id="container-des">
            <br>
            <b class="des">Description</b>
            <img src="{{(asset('front-assets/images/arrow.png'))}}" id="arrowimage" class="arrow" align="right" onclick="toggleDescription()">
            <p>Matrix &reg;Amino is syntrax most comprehensive amino acid supplement available to athlets<br><br>
            No other formula from syntax contains the same high quantities and precise ratios of muscle-supprting amino acids, such as leucine, valine, isoleucine and HICA (the leucine meta-<br>
            bolie that is claimed to be 4 times as strong as leucinr at only 1/4 the dosage). Matrix &reg; Amino also contains a decent dose of cituline and beta-alanine to maintain optimal blood flow.<br>
            muscle pump, and muscular endurance during intense exercise.Finally, a halthy dose of hydrstion-promoting electrolytes are included to help athletes power through every workout.
        </p>
        </div>
        
        <div class="container" id="container-below">
            <b class="des">Suggested Use</b>
            <img src="{{(asset('front-assets/images/arrow.png'))}}" class="arrow" align="right">
        </div><br>
        <div class="container" id="container-below">
            <b class="des">Ingredients</b>
            <img src="{{(asset('front-assets/images/arrow.png'))}}" class="arrow" align="right">
        </div><br>
        <div class="container" id="container-below">
            <b class="des">Product Details</b>
            <img src="{{(asset('front-assets/images/arrow.png'))}}" class="arrow" align="right">
        </div><br>
        <div class="container" id="container-below">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">
                          <b>  Reviews</b>
                            <img src="{{ asset('front-assets/images/arrow.png') }}" class="arrow" id="review_arrow">
                        </button>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                
                <div class="container">
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="col-md-8">
                        <div class="row">
                            <form name="productRatingForm" id="productRatingForm" method="post">
                                @csrf
                                <h3 class="h4 pb-3">Write a Review</h3>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" class="@error('name') is-invalid @enderror form-control form-control-lg">
                                    <p></p>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                    <p></p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="rating">Rating</label>
                                    <br>
                                    <div class="rating" style="width: 10rem">
                                        <input id="rating-5" type="radio" name="rating" value="5"><label for="rating-5"><i class="fas fa-3x fa-star" id="starss"></i></label>
                                        <input id="rating-4" type="radio" name="rating" value="4"><label for="rating-4"><i class="fas fa-3x fa-star" id="starss"></i></label>
                                        <input id="rating-3" type="radio" name="rating" value="3"><label for="rating-3"><i class="fas fa-3x fa-star" id="starss"></i></label>
                                        <input id="rating-2" type="radio" name="rating" value="2"><label for="rating-2"><i class="fas fa-3x fa-star" id="starss"></i></label>
                                        <input id="rating-1" type="radio" name="rating" value="1"><label for="rating-1"><i class="fas fa-3x fa-star" id="starss"></i></label>
                                    </div>
                                    <p class="product-rating-error"></p>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="comment">How was your overall experience?</label>
                                    <textarea name="comment" id="comment" class="form-control" cols="30" rows="10" placeholder="How was your overall experience?" required></textarea>
                                    <p></p>
                                </div>
                                <div>
                                    <button class="btn btn-dark">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="row">
    <div class="overall-rating mb-3 col-md-4">
        <div class="d-flex">
            <h1 class="h3 pe-3">{{ $avgRating }}</h1>
            <div class="star-rating mt-2" title="70%">
                <div class="back-stars">
                    <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                    <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                    <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                    <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                    <i class="fa fa-star" class="back-stars" aria-hidden="true"></i>
                    <div class="front-stars" style="width: {{ $avgRatingPer }}%">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="pt-2 ps-2">({{ $products->product_ratings_count }} {{ $products->product_ratings_count > 1 ? 'Reviews' : 'Review' }})</div>
        </div>
    </div>

    {{-- Sorting for reviews --}}
    <div class="col-md-2">
    <div id="reviewSortForm">
        <select name="sortCriteria" id="sortCriteria">
            <option value="top_rated">Top Rated</option>
            <option value="poor_rated">Poor Rated</option>
        </select>
      
    </div>
    </div>
    <!-- Container to hold sorted reviews -->
    <div id="sortedReviewsContainer">
        <!-- AJAX will update this section -->
    
    
    @if ($products->product_ratings->isNotEmpty())
        @php
            $sortedRatings = $products->product_ratings->sortByDesc('rating');
        @endphp

        @foreach ($sortedRatings as $rating)
            @php
                $ratingPer = ($rating->rating * 100) / 5;
            @endphp
            <div class="rating-group mb-4">
                <p><strong class="product-rating">{{ $rating->name }}</strong></p>
                <div class="star-rating mt-2" title="">
                    <div class="back-stars">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <div class="front-stars" style="width: {{ $ratingPer }}%">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="my-3">
                    <p class="product-rating">{{ $rating->comment }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div></div>
                    </div>
                </div>

        </div><br><br>
        <div class="container">
        <h6 class="h6">OTHERS ALSO LOOKED AT</h6><br><br>
        </div>
        
        <div class="container">
            <div class="row">
              <div class="col" id="im-1">
                <div class="img-container" >
                  <img src="{{(asset('front-assets/images/bottle1.png'))}}" alt="Image 1">
                  <p class="bp2">Viterna<br>Premium Whey Isolate</p>
                  <p class="price">34.90</p>
                  <button class="btn-add-to-cart">Add to Cart</button>
                </div>
              </div>
              <div class="col" id="im-2">
                <div class="img-container" >
                  <img src="{{(asset('front-assets/images/bottle2.png'))}}" alt="Image 2" >
                  <p class="bp">Life Extension<br>Vitamin D3(1000 IU)</p>
                  <p class="price"><strike>39.50</strike>24.90</p>
                  <button class="btn-add-to-cart">Add to Cart</button>
                </div>
              </div>
              <div class="col" id="img">
                <div class="img-container" >
                  <img src="{{(asset('front-assets/images/bottle3.png'))}}" alt="Image 3" >
                  <p class="bp3">Scitec Nutrition<br>100% Whey Isolate</p>
                  <p class="price">19.67</p>
                  <button class="btn-add-to-cart">Add to Cart</button>
                </div>
              </div>
              <div class="col" id="img">
                <div class="img-container" >
                  <img src="{{(asset('front-assets/images/bottle4.png'))}}" alt="Image 4" >
                  <p class="bp">Scitec Nutrition<br>100% Wheny Protein Professional</p>
                  <p class="price">23.80</p>
                  <button class="btn-add-to-cart">Add to Cart</button>
                </div>
              </div>
              <div class="col" id="img">
                <div class="img-container"  >
                  <img src="{{(asset('front-assets/images/bottle5.png'))}}" alt="Image 5">
                  <p>HD Muscle -Pre-HD Ultra<br></p><br>
                  <p class="price">42.90</p>
                  <button class=" btn-add-to-cart">Add to Cart</button>
                </div>
              </div>
            </div>
          </div><br>
    

<div class="container-fluid">
          <div class="container" id="person">
            <div class="row">
                <div class="col-sm-2">
                    <br><br>
                  <img src="{{(asset('front-assets/images/person.png'))}}" class="img-person">
                </div>
                <div class="col" id="col-person">
                    <br><br>
                    <b>Daniel Emil Ussing</b>
                    <p>Pharmacy Technician & Product Specialist<br><br>
                    Educated at the Danish School of Pharmacy Technicians & Acting specialist in Dietary Supplements. If you have any questions,about the effects,<br>
                    ingredients or integrity of the product, please don't hesitate to contact me.Visit my Linkedin profile for Reference<br>
                    <br>
                    <b class="read">Read More ></b>
                    </p>
                </div>
            </div>
          </div>
</div>
    </div><br><br>
    <div class="container-fluid" id="home">
        <div class="container">
        <div class="row">
            <div class="col-sm-1">
                <img src="{{(asset('front-assets/images/home.png'))}}"class="hai">
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
 
    <script>
    function toggleDescription() {
        var description = document.getElementById('description');
        if (description.style.display === 'none') {
            description.style.display = 'block';
        } else {
            description.style.display = 'none';
        }
    }
</script>
<script>
  $(document).ready(function() {
    $('#productRatingForm').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: '{{ route("front.saveRating", $products->id) }}',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === false) {
                    // Handle validation errors
                    if (response.errors) {
                        if (response.errors.name) {
                            $("#name").addClass('is-invalid').siblings("p")
                                .addClass('invalid-feedback')
                                .html(response.errors.name);
                        } else {
                            $("#name").removeClass('is-invalid').siblings("p")
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (response.errors.email) {
                            $("#email").addClass('is-invalid').siblings("p")
                                .addClass('invalid-feedback')
                                .html(response.errors.email);
                        } else {
                            $("#email").removeClass('is-invalid').siblings("p")
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (response.errors.comment) {
                            $("#comment").addClass('is-invalid').siblings("p")
                                .addClass('invalid-feedback')
                                .html(response.errors.comment);
                        } else {
                            $("#comment").removeClass('is-invalid').siblings("p")
                                .removeClass('invalid-feedback')
                                .html('');
                        }

                        if (response.errors.rating) {
                            $(".product-rating-error").html(response.errors.rating);
                        } else {
                            $(".product-rating-error").html('');
                        }
                    }
                } else {
                    // Handle success
                    window.location.href="{{route('update.detail', $products->id)}}";
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.log('Status:', status);
                console.log('Error:', error);
                console.log('Response:', xhr.responseText);
                alert('An error occurred while submitting the form. See console for details.');
            }
        });
    });
});

// If using plain JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const target = document.querySelector(tab.getAttribute('data-bs-target'));

            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            tabPanes.forEach(pane => pane.classList.remove('active'));
            target.classList.add('active');
        });
    });
});

// If using jQuery
$(document).ready(function() {
    $('.tab').on('click', function() {
        const target = $($(this).data('bs-target'));

        $('.tab').removeClass('active');
        $(this).addClass('active');

        $('.tab-pane').removeClass('active');
        target.addClass('active');
    });
});

</script>
<script>
    $(document).ready(function() {
        $('#sortCriteria').change(function() {
            var sortCriteria = $(this).val();
            var productId = "{{ $products->id }}"; // Replace with your actual product ID

            $.ajax({
                url: '/product/' + productId + '/sort-reviews',
                type: 'GET',
                data: {
                    review_sort: sortCriteria
                },
                success: function(response) {
                    $('#sortedReviewsContainer').html(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    // Handle error response
                }
            });
        });

        // Trigger initial load based on default sorting (optional)
        $('#sortCriteria').trigger('change');
    });
    </script>
@endsection
