<!-- partials/category.blade.php -->

@php
    $categoryId = $category->id;
@endphp
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
       <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
<div class="list-group-item category-item">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $category->category_name }}</h5>
        <div class="category-actions">
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary mr-2">
                <i class="fas fa-edit"></i> 
            </a>
            <form id="delete-category-form-{{ $category->id }}" action="{{ route('categories.delete', $category->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-trash"></i> 
                </button>
            </form>
            <!-- Button to toggle create subcategory form -->
            <button class="btn btn success ml-2" onclick="toggleSubcategoryForm('{{ $category->id }}')">
                <i class="fas fa-plus"></i>
            </button>
            <!-- Button to toggle products modal -->
            <button class="btn btn-sm btn primary ml-2" onclick="showProducts('{{ $category->id }}')">
                <i class="fas fa-shopping-cart"></i> 
            </button>
            <!-- Arrow icon for toggle subcategories -->
            <i class="fas fa-chevron-right ml-2 toggle-subcategories" styles="display: {{ count($category->children) > 0 ? 'inline-block' : 'none' }};" onclick="toggleSubcategories(this)"></i>
        </div>
    </div>

    <!-- Subcategories for the current category -->
    <div class="subcategories">
        <ul id="subcategory-list-{{ $category->id }}">
            @foreach($category->children as $child)
                @include('partials.category', ['category' => $child])
            @endforeach
        </ul>
    </div>

    <!-- Form to create subcategory -->
    <div class="create-subcategory-form" id="create-subcategory-form-{{ $category->id }}">
        <hr>
        <form id="form-create-subcategory-{{ $category->id }}" action="{{ route('categories.store') }}" method="POST" onsubmit="submitSubcategoryForm(event, '{{ $category->id }}')">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $category->id }}">
            <div class="form-group">
                <label for="subcategory_name">Subcategory Name</label>
                <input type="text" class="form-control" id="subcategory_name" name="category_name" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Subcategory</button>
        </form>
    </div>

    <div class="modal fade" id="productsModal-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productsModalLabel">Products in {{ $category->category_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="assign-products-form-{{ $category->id }}" action="{{ route('categories.assignProducts', ['id' => $category->id]) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card border-0 shadow-sm my-4">
                                    <div class="card-header bg-dark">
                                        <h3 class="text-white">Products</h3>
                                    </div>
                                    <div class="card-body">
                                    <table class="table table-responsive-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Description</th>
            <th>Assign</th>
            <th>Pin</th>
        </tr>
    </thead>
    <tbody id="sortable-products-{{ $category->id }}">
        <!-- Display pinned products first -->
        @foreach($products as $product)
            @if (in_array($product->id, $categoryPins[$category->id] ?? []))
                <tr id="product-{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset('uploads/products/' . $product->image) }}" width="50" alt="Product Image"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <input type="checkbox" name="products[]" value="{{ $product->id }}" 
                            {{ in_array($product->id, $categoryProducts[$category->id] ?? []) ? 'checked' : '' }}>
                    </td>
                    <td>
                        @if (in_array($product->id, $categoryPins[$category->id] ?? []))
                            <form action="{{ route('products.unpin', ['productId' => $product->id, 'categoryId' => $categoryId]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link p-0">
                                    <i class="fas fa-thumbtack fa-lg text-primary"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach

        <!-- Display non-pinned products -->
        @foreach($products as $product)
            @if (!in_array($product->id, $categoryPins[$category->id] ?? []))
                <tr id="product-{{ $product->id }}">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td><img src="{{ asset('uploads/products/' . $product->image) }}" width="50" alt="Product Image"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <input type="checkbox" name="products[]" value="{{ $product->id }}" 
                            {{ in_array($product->id, $categoryProducts[$category->id] ?? []) ? 'checked' : '' }}>
                    </td>
                    <td>
                        @if (!in_array($product->id, $categoryPins[$category->id] ?? []))
                            <form action="{{ route('products.pin', ['productId' => $product->id, 'categoryId' => $categoryId]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link p-0">
                                    <i class="fa fa-thumbtack fa-lg text-secondary"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Assign Products</button>
                </div>
</div>
            </form>
        </div>
    </div>
</div>


<script>
// Example JavaScript to toggle products modal visibility
function showProducts(categoryId) {
    $('#productsModal-' + categoryId).modal('show');
}
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Function to toggle products modal visibility
    function showProducts(categoryId) {
        $('#productsModal-' + categoryId).modal('show');
    }


    // Function to update pin UI based on state
    function updatePinUI(button, isPinned) {
        var icon = $(button).find('i');
        if (isPinned) {
            icon.removeClass('fa fa-thumbtack fa-lg text-secondary').addClass('fas fa-thumbtack fa-lg text-primary'); // Pinned state
        } else {
            icon.removeClass('fas fa-thumbtack fa-lg text-primary').addClass('fa fa-thumbtack fa-lg text-secondary'); // Unpinned state
        }
    }

    // Attach togglePin function to click event of pin-toggle buttons
    $(document).on('click', '.pin-toggle', function() {
        togglePin(this);
    });
});
</script>
</script>
<!-- Include jQuery from CDN -->


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize sortable on the tbody element with ID specific to the category
        $('#sortable-products-{{ $category->id }}').sortable({
            update: function(event, ui) {
                // Get the updated order of product IDs
                var productOrder = $(this).sortable('toArray', { attribute: 'id' });
                
                // Send the updated order to the server
                $.ajax({
                    url: '{{ route("categories.updatePositions", ["categoryId" => $category->id]) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productOrder: productOrder
                    },
                    success: function(response) {
                        console.log('Order updated successfully');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating order:', error);
                    }
                });
            }
        }).disableSelection();
    });
</script>




