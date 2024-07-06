@extends('layouts.front')

@section('page-title', 'home')

@section('front')
    <div class="container">
        <div class="row">
          <div class="col-sm-3" id="im1">
            
              <img src="{{(asset('front-assets/images/image1.png'))}}" alt="Image 1">
              
            
        </div>
          <div class="col-sm-3" id="im2">
         
              <img src="{{(asset('front-assets/images/image2.png'))}}" alt="Image 2" >
            
          </div>
          <div class="col-sm-3" id="im3">
           
              <img src="{{(asset('front-assets/images/image3.png'))}}" alt="Image 3" >
            
          </div>
          <div class="col-sm-3" id="im4">
      
              <img src="{{(asset('front-assets/images/image4.png'))}}" alt="Image 3" class="sm-img">
            
          </div>
          
        </div>
      </div><br>
      @if(Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                {{Session::get('success')}}
                </div>
            </div>
            @endif
    <div class="container">
        <div class="row">
            <div class="col-sm-6"><br>
                <h6 class="popular">POPULAR PRODUCTS</h6><br>
            </div>
            <div class="col-sm-6" id="view"><br>
                <u><b>View All Products</b></u>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach($product as $products)
          <div class="col" id="im1">
            <div class="img-container" onclick="details('{{ $products->id }}')" >
              <img src="{{ asset('uploads/products/' . $products->image) }}" alt="Image 1" width="100%" height="100%"><br>
              <p class="bp2">{{$products->name}}</p>
              <p class="price">{{$products->price}}</p>
              <button class="btn-add-to-cart" >Add to Cart</button>
            </div>
          </div>
          @endforeach
          
          
        </div>
      </div><br>
    
    <div class="container">
        <div class="row">
          <div class="col-sm-4" id="">
            <div class="img-container11" >
                <p class="h">Review a product & get a</p>
                <h2 class="h">12% discount</h2>
                <p >Receive a 12% discount code when you review a product <br>from your latest order on our website</p>
            </div>
          </div>
          <div class="col-sm-4" id="">
            <div class="img-container11" >
                <p class="h">Sign up for our</p>
                <h2 class="h">Newsletter</h2>
                <p >Never miss the latest news of our products, <br>campaign and more</p>
            </div>
          </div>
          <div class="col-sm-4" id="">
            <div class="img-container11" >
                
                <h4 class="ex">Excellent</h4>
              <img src="{{(asset('front-assets/images/t1.png'))}}"><br>
              <small>Based on<u><b>523 reviews</b></u></small><br>
              <img src="{{(asset('front-assets/images/t2.png'))}}">
            </div>
          </div>
        </div>
          
        </div>
      </div><br>



    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="popular">NEW ARRIVALS</h4><br>
            </div>
            <div class="col-sm-6" id="view">
                <u><b>View All Products</b></u>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        @foreach($new as $news)
          <div class="col" id="im1">
            <div class="img-container" onclick="details('{{ $news->id }}')" >
              <img src="{{ asset('uploads/products/' . $news->image) }}" alt="Image 1" ><br>
              <p class="bp2">{{$news->name}}</p>
              <p class="price">{{$news->price}}</p>
              <button class="btn-add-to-cart" >Add to Cart</button>
            </div>
          </div>
          @endforeach
        </div>
      </div><br>
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
@endsection