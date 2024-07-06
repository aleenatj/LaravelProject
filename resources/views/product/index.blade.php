@extends('layouts.app')

@section('page-title', 'Products')

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
                        <h3 class="text-white">Products</h3>
                    </div>  
                    <div class="card-body">
                        <table class="table table-responsive-sm">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image
                                   
                                </th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Descrption</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if($products->isNotEmpty())
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name}}</td>
                                <td><img width="50" src="{{ asset('uploads/products/' . $product->image) }}"></td>

                                <td>{{$product->price}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M,Y')}}</td>
                                <td>
                                <a href="{{route('product.edit',$product->id)}}" class="btn btn-dark">Edit</a>
                                <a href="#" onclick="deleteProduct('{{ $product->id }}');" class="btn btn-secondary">Delete</a>
                                   <form id="delete-product-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="post">
                                    @csrf
                                      @method('delete')
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

  </body>
</html>
<script>
    function deleteProduct(id){
        
        if(confirm("Are you sure you want to delete the product?")){
            document.getElementById("delete-product-form-"+id).submit();
        }
    }
</script>
@endsection