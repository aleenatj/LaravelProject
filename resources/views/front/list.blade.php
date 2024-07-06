@extends('layouts.front')

@section('page-title', 'details')


@section('front')
<div class="container mt-5">
    <h3 class="popular_top">POPULAR PRODUCTS</h2>
<div class="row product-grid grid-1">
        @foreach($products->take(5) as $key => $product)
        <div class="col">
            <div class="img-container" onclick="details('{{ $product->id }}')">
                @if($product->pivot->pinned)
                <i class="fa fa-thumbtack pinned-icon"></i>
                @endif
                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image">
                <p class="bp2">{{ $product->name }}</p>
                <p class="price">${{ $product->price }}</p>
                <button class="btn-add-to-cart">Add to Cart</button>
            </div>
        </div>
        @endforeach
        @for ($i = count($products); $i < 5; $i++)
        <div class="col">
            <div class="img-container">
                <!-- Empty container placeholder -->
            </div>
        </div>
        @endfor
    </div>
</div>

<div class="container mt-5">
    <div class="row product-grid grid-2">
        
    </div>
    <div class="sort-container">
    <div class="price-slider-container">
             
             <div id="price-slider"></div>
             <span id="price-range"></span>
         </div>
         <br>
    </div>
        <div class="container">
            <div class="d">
            <h5>{{$subcategory->category_name}}</h5>
              
      <div class="sort-container">
        <div>
            <label class="sort-label" for="sort-by">Sort by:</label>
            <select id="sort-by" onchange="sortProducts(this.value)">
    <option value="default">Price</option>
    <option value="low-to-high">Price: Low to High</option>
    <option value="high-to-low">Price: High to Low</option>
</select>

        </div>
        <div>
</div>
                <div>
                <label class="sort-label" for="sort-by">Sort by:</label>
            <select id="sort-by" onchange="sortProductsName(this.value)">
    <option value="default">Name</option>
    <option value="asc">A-Z</option>
    <option value="desc">Z-A</option>
</select>
                </div>
              </div><br>
              
              <div class="container">
    <div class="row product-grid grid-1">
        @foreach($products->take(5) as $key => $product)
        <div class="col">
            <div class="img-container" onclick="details('{{ $product->id }}')">
                @if($product->pivot->pinned)
                <i class="fa fa-thumbtack pinned-icon"></i>
                @endif
                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Product Image">
                <p class="bp2">{{ $product->name }}</p>
                <p class="price">${{ $product->price }}</p>
                <button class="btn-add-to-cart">Add to Cart</button>
            </div>
        </div>
        @endforeach
        @for ($i = count($products); $i < 5; $i++)
        <div class="col">
            <div class="img-container">
                <!-- Empty container placeholder -->
            </div>
        </div>
        @endfor
    </div>
</div>

<div class="container mt-5">
    <div class="row product-grid grid-2">
        @foreach($products->slice(5, 5) as $key => $product)
        <div class="col">
            <div class="img-container" onclick="details('{{ $product->id }}')">
                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Image {{ $key + 6 }}">
                <p class="bp2">{{ $product->name }}</p>
                <p class="price">${{ $product->price }}</p>
                <button class="btn-add-to-cart">Add to Cart</button>
            </div>
        </div>
        @endforeach
    </div>
</div>


             <br>
             <div class="sort-container">
              <div>
        <label class="show-items-label" for="show-items">Show items:</label>
        <select id="show-items" onchange="changeItemsPerPage(this.value)">
            <option value="5" {{ ($itemsPerPage == 5) ? 'selected' : '' }}>5</option>
            <option value="10" {{ ($itemsPerPage == 10) ? 'selected' : '' }}>10</option>
            <option value="20" {{ ($itemsPerPage == 20) ? 'selected' : '' }}>20</option>
            <option value="50" {{ ($itemsPerPage == 50) ? 'selected' : '' }}>50</option>
        </select>
    </div>
   
                <div>
                <ul class="pagination">
            <li><a href="{{ $products->previousPageUrl() }}" @if (!$products->onFirstPage()) onclick="pagination('{{ $products->currentPage()-1 }}')" @endif>&laquo;</a></li>
            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="{{ ($products->currentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $products->url($i) }}" onclick="pagination('{{ $i }}')">{{ $i }}</a>
                </li>
            @endfor
            <li><a href="{{ $products->nextPageUrl() }}" @if ($products->hasMorePages()) onclick="pagination('{{ $products->currentPage()+1 }}')" @endif>&raquo;</a></li>
        </ul>
                      
                </div>
              </div><br>
              <div class="p1">
                <p><b>Dietary Supplements with BCAA & EAA Amino Acids</b></p>
                <p>In connection with fitness and bodybuilding,one does not get around the amino acids.
                    THere are different products and compositions that are usually not making sense,unless you<br>
                    what is being refered to.The best known examples are BAA(Branched Chain Amino Acids) and EAA(Essential Amino Acids).
                </p>
                <p>Branched Chain Amino Acids contain 3 important amino acids for affecting mTOR(protein synthesis) these L-Leuicine and L-Isoleuicne.EAA Essential amino acods contain 9<br>
                Essensial amino acids.</p>
              </div>
              <div class="container-images">
                <div class="row">
                    <div class="col-sm-2">
                <img src="{{(asset('front-assets/images/img2.png'))}}" class="img">
                <h6>JENNI AASKOV </h6>
                <p>Kundeservice</p>
                </div>
                <div class="col-sm-2">
                <img src="{{(asset('front-assets/images/img1.png'))}}" class="img">
                <br>
                <h6>DANIEL EMIL USSING</h6>
                <p>Product Specialist</p>
                <p></p>
              </div>
              </div>
            </div>
            </div>
              </div>
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
    <script>
       function changeItemsPerPage(value) {
        // Assuming you have a route to fetch products with pagination
        var url = "{{ route('category.show', ['subcategory' => $subcategory->id]) }}";
        url = url + "?itemsPerPage=" + value; // Append itemsPerPage parameter

        window.location.href = url; 
    }
      </script>
   <script>
document.addEventListener('DOMContentLoaded', function () {
    var slider = document.getElementById('price-slider');
    var priceRange = document.getElementById('price-range');
    var productGrid1 = document.querySelector('.product-grid.grid-1');
    var productGrid2 = document.querySelector('.product-grid.grid-2');

    noUiSlider.create(slider, {
        start: [0, 100], // Initial range, adjust as per your needs
        connect: true,
        range: {
            'min': 0,
            'max': 100 // Adjust max value according to your product price range
        },
        tooltips: [true, true],
        format: {
            to: function (value) {
                return '$' + value.toFixed(2);
            },
            from: function (value) {
                return Number(value.replace('$', ''));
            }
        }
    });

    slider.noUiSlider.on('update', function (values, handle) {
        priceRange.innerHTML = values.join(' - ');

        // Fetch products based on the price range
        fetchProductsByPriceRange(values[0].replace('$', ''), values[1].replace('$', ''));
    });

    function fetchProductsByPriceRange(minPrice, maxPrice) {
        // AJAX call to fetch products
        var url = "{{ route('products.filter') }}";
        url = url + "?min_price=" + minPrice + "&max_price=" + maxPrice;

        console.log('Fetching products with URL:', url);

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(products => {
                updateProductGrid(products); // Update the product grids with fetched products
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    }

    function updateProductGrid(products) {
    var grid1 = document.querySelector('.product-grid.grid-1');
    var grid2 = document.querySelector('.product-grid.grid-2');

    // Clear existing products from grids
    grid1.innerHTML = '';
    grid2.innerHTML = '';

    // Iterate over products and update grids
    products.forEach(function(product, index) {
        var grid = index < 5 ? grid1 : grid2; // Determine which grid to update

        // Construct HTML for each product
        var html = `
            <div class="col">
                <div class="img-container" onclick="details('${product.id}')">
                    ${product.pinned ? '<i class="fa fa-thumbtack pinned-icon"></i>' : ''}
                    <img src="{{ asset('uploads/products/') }}/${product.image}" alt="Product Image">
                    <p class="bp2">${product.name}</p>
                    <p class="price">$${product.price}</p>
                    <button class="btn-add-to-cart">Add to Cart</button>
                </div>
            </div>
        `;

        // Append product HTML to the respective grid
        grid.insertAdjacentHTML('beforeend', html);
    });

    // Fill empty placeholders if fewer than 5 products are returned
    if (products.length < 5) {
        for (var i = products.length; i < 5; i++) {
            var emptyHtml = `
                <div class="col">
                    <div class="img-container">
                        <!-- Empty container placeholder -->
                    </div>
                </div>
            `;
            grid1.insertAdjacentHTML('beforeend', emptyHtml); // Assuming grid1 as default
        }
    }
}

});
</script>

@endsection

