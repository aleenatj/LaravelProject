<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Welcome,</h3>
    </div>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('categories.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categories.update',$category->id) }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="category_id" value="{{Request('id')}}">
                            @csrf
                            @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="dw dw-checked"></i></strong>
                                {!! Session::get('success') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if (Session::has('fail'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="dw dw-checked"></i></strong>
                                {!! Session::get('fail') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="category_name">Category name</label>
                                <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" id="category_name" placeholder="Category name" value="{{$category->category_name}}">
                                @error('category_name')
                                <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-secondary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>
