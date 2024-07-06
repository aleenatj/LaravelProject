@extends('layouts.app')

@section('page-title', 'Products')

@section('content')
<div class="container-flex">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <div class="col-md">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">Back</a>
            </div>
            <a href="{{ route('product.create') }}" class="btn btn-dark">Create</a>
        </div>

        @if(Session::has('success'))
        <div class="col-md-10 mt-4">
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
        @endif

        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Products</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                          
                                <th>Ratings</th>
                                <th>Username</th>
                                <th>Comment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ratings as $rating)
                            <tr>
                                <td>{{ $rating->id }}</td>
                                <td>{{ $rating->productName }}</td>
                              
                                <td>{{ $rating->rating }}</td>
                                <td>{{ $rating->name }}</td>
                                <td>{{ $rating->comment }}</td>
                                <td>
                                    @if($rating->status == 1)
                                    <a href="javascript:void(0);" onclick="changeStatus(0,'{{$rating->id}}');">
                                    <i class="fa-solid fa-circle-check text-success"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(1);" onclick="changeStatus(1,'{{$rating->id}}');">
                                    <i class="fa-solid fa-xmark text-danger"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No ratings found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




<script>
    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete the product?")) {
            document.getElementById("delete-product-form-" + id).submit();
        }
    }
</script>
<script>
    function changeStatus(status,id){
        if(confirm("Are you sure you want to change the status")){
            $.ajax({
                url:'{{route("product.changeRatingSatus")}}',
                type:'get',
                data:{status:status,id:id},
                dataType:'json',
                success:function(response){
                    window.location.href="{{route('product.productRating')}}"
                }
            })
        }
    }
</script>

@endsection