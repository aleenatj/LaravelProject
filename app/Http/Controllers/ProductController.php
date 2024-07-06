<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(){
        $products =Product::orderBy('created_at', 'DESC')->get();

        return view('product.index',[
        'products' =>$products
        ]);
    }
    public function create(){
        return view('product.create');

    }
    public function store(Request $request){
        $validateData= $request->validate([
              'name'=>'required',
              'price'=>'required',
              'category'=>'required',
              'description'=>'required',
              'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
              
          ]);
          
      
       $product=new Product();
       $product->name=$validateData['name'];
       $product->price=$validateData['price'];
       $product->category=$validateData['category'];
       $product->description=$validateData['description'];
    

       $image=$validateData['image'];
       $ext=$image->getClientOriginalExtension();
       $imageName=time().'.'.$ext;

       $image->move(public_path('uploads/products'),$imageName);


       $product->image=$imageName;
       $product->save();
      
       $product->categories()->sync($validateData['categories']);
       
        return redirect()->route('product.index')->with('success','Product added successfully');
  
       
      }
      public function edit($id){
        $product = Product::findOrFail($id);
        return view('product.edit',[
        'products' =>$product
        ]);
      }
      public function update($id, Request $request){
        $product = Product::findOrFail($id);
    
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required'
            // // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    

        $product->name = $validateData['name'];
        $product->price = $validateData['price'];
        $product->category = $validateData['category'];
        $product->description = $validateData['description'];
    

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $ext = $image->getClientOriginalExtension();
        //     $imageName = time() . '.' . $ext;
        //     $image->move(public_path('uploads/products'), $imageName);
    

        //     $product->image = $imageName;
        // }
    
    
        $product->save();
    
      
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }
    
      public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('success','Product deleted successfully.');
       
    }
 
    
    public function pinProduct(Request $request, $productId, $categoryId)
    {
        // Assuming you have a model called CategoryProduct for the pivot table
        DB::table('product_category')->updateOrInsert(
            ['product_id' => $productId, 'category_id' => $categoryId],
            ['pinned' => true]
        );
    
        return redirect()->back();
    }
    
    public function unpinProduct(Request $request, $productId, $categoryId)
    {
        // Assuming you have a model called CategoryProduct for the pivot table
        DB::table('product_category')->updateOrInsert(
            ['product_id' => $productId, 'category_id' => $categoryId],
            ['pinned' => false]
        );
    
        return redirect()->back();
    }
    public function filterProducts(Request $request)
    {
        $minPrice = $request->query('min_price', 0);
        $maxPrice = $request->query('max_price', 100);
        $sortBy = $request->query('sort_by', 'price');
        $sortOrder = $request->query('sort_order', 'asc');
        $itemsPerPage = $request->query('items_per_page', 5);
    
        // Query products based on filters
        $query = Product::whereBetween('price', [$minPrice, $maxPrice]);
    
        if ($sortBy && in_array($sortBy, ['price', 'name', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            // Default sorting if invalid sortBy parameter is provided
            $query->orderBy('price', 'asc');
        }
    
        // Paginate the results
        $products = $query->paginate($itemsPerPage);
    
        // Extract the products data from the pagination object
        $productsData = $products->items();
    
        return response()->json($productsData);
    }
    
    public function productRatings(){
        $ratings = ProductRating::select('product_rating.*', 'product.name as productName')
                        ->orderBy('product_rating.created_at', 'DESC')
                        ->leftJoin('product', 'product.id', 'product_rating.product_id')
                        ->get();
    
        return view('product.ratings', ['ratings' => $ratings]);
    }
    public function changeRatingSatus(Request $request){
        $productRating=ProductRating::find($request->id);
        $productRating->status=$request->status;
        $productRating->save();

        session()->flash('success','status changed successfully');

        return response()->json([
            'status'=>true
        ]);
    }
    public function sortReviews(Request $request, Product $product)
    {
        // Validate the sorting criteria
        $request->validate([
            'review_sort' => 'required|in:top_rated,poor_rated',
        ]);

        // Determine sorting criteria
        $sortCriteria = $request->input('review_sort');

        // Load the product with sorted reviews
        $product = $product->load(['product_ratings' => function ($query) use ($sortCriteria) {
            if ($sortCriteria == 'top_rated') {
                $query->orderByDesc('rating');
            } elseif ($sortCriteria == 'poor_rated') {
                $query->orderBy('rating');
            }
        }]);

        // Render the sorted reviews HTML directly
        $html = '';
        if ($product->product_ratings->isNotEmpty()) {
            foreach ($product->product_ratings as $rating) {
                $ratingPer = ($rating->rating * 100) / 5;
                $html .= '<div class="rating-group mb-4">';
                $html .= '<p><strong class="product-rating">' . $rating->name . '</strong></p>';
                $html .= '<div class="star-rating mt-2" title="">';
                $html .= '<div class="back-stars">';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<div class="front-stars" style="width: ' . $ratingPer . '%">';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="my-3">';
                $html .= '<p class="product-rating">' . $rating->comment . '</p>';
                $html .= '</div>';
                $html .= '</div>';
            }
        } else {
            $html = '<p>No reviews found.</p>';
        }

        return $html;
    }

}