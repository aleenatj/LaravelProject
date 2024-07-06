@extends('layouts.app')

@section('page-title', 'Orders')

@section('content')
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Product Details</h3>
    </div>
    <div class="container">
    <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{route('product.index')}}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify content-center">
            <div class="col-md-10">
                <div class="card borde-0 shadow-1g my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Product</h3>
                    </div>
                    <form method="post" action="{{route('product.update',$products->id)}}">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="" class="form-label h5">Name</label>
                            <input value="{{old('name',$products->name)}}" type="text" class="form-control form-control-lg" placeholder="Name" 
                            name="name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Price</label>
                            <input value="{{old('price',$products->price)}}" type="text" class="form-control form-control-lg" placeholder="price" 
                            name="price">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Category</label>
                            <input value="{{old('category',$products->category)}}" type="text" class="form-control form-control-lg" placeholder="Category" 
                            name="category">
                        </div>
                        
                        <div class="mb-3">
                            <label for="" class="form-label h5">Description</label>
                            <textarea  type="text" class="form-control form-control-lg" placeholder="Description" 
                            name="description" cols="30" rows="4">{{old('description',$products->description)}}
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label h5">Image</label>
                            <input  type="file" class="form-control form-control-lg" placeholder="image" 
                            name="image">
                            <img width="w-50 my-3" src="{{ asset('uploads/products/' . $products->image) }}">
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-secondary">Update</button>
                        </div>
                    </div>

     
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection