
@extends('layouts.app')

@section('page-title', 'Orders')

@section('content')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="col-md">
            
            </div>
                <div class="text-right mb-3">
               
                    <a href="{{ route('categories.add') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-plus"></i> Add Category
                    </a>
                </div>
                <div class="card border-0 shadow-lg">
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($categories as $category)
                                @include('partials.category', ['category' => $category])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function togglePin(button) {
        var productId = $(button).data('product-id');

        // Perform AJAX request to toggle pin state
        $.ajax({
            url: '/toggle-pin/' + productId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.pinned) {
                    $(button).html('<i class="fas fa-thumbtack fa-lg text-primary"></i>'); // Update to pinned icon
                } else {
                    $(button).html('<i class="far fa-thumbtack fa-lg text-secondary"></i>'); // Update to unpinned icon
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to toggle pin state.');
            }
        });
    }
</script>

    <!-- Bootstrap JS and dependencies -->
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript code for deleteCategory(), toggleSubcategories(), toggleSubcategoryForm(), and submitSubcategoryForm() functions -->
    <script>
    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete the category?")) {
            fetch(`/categories/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle success
                console.log('Category deleted:', data.message);
                // Optionally, update UI to reflect deletion
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error
            });
        }
    }

    function toggleSubcategories(element) {
        var subcategories = element.closest('.list-group-item').querySelector('.subcategories');
        if (subcategories.style.display === "none") {
            subcategories.style.display = "block";
            element.classList.remove('fa-chevron-right');
            element.classList.add('fa-chevron-down');
        } else {
            subcategories.style.display = "none";
            element.classList.remove('fa-chevron-down');
            element.classList.add('fa-chevron-right');
        }
    }

    function toggleSubcategoryForm(categoryId) {
        var form = document.getElementById('create-subcategory-form-' + categoryId);
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
    </script>
<script>
 
    function togglePin(button) {
        var productId = $(button).data('product-id');

        // Perform AJAX request to toggle pin state
        $.ajax({
            url: '/toggle-pin/' + productId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.pinned) {
                    $(button).html('<i class="fas fa-thumbtack fa-lg text-primary"></i>'); // Update to pinned icon
                } else {
                    $(button).html('<i class="far fa-thumbtack fa-lg text-secondary"></i>'); // Update to unpinned icon
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('Failed to toggle pin state.');
            }
        });
    }


</script>




@endsection
