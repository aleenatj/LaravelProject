<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Product;

use \Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminCategoriesController extends Controller
{
    public function list()
    {
        // Fetch categories with their products ordered by position in product_category table
        $categories = Category::with(['products' => function ($query) {
                $query->orderBy('product_category.position', 'ASC')
                      ->withPivot('pinned');
            }])
            ->whereNull('parent_id')
            ->get();
    
        // Step 1: Fetch product IDs ordered by their position in the product_category table
        $orderedProductIds = DB::table('product_category')
            ->orderBy('position', 'ASC')
            ->pluck('product_id')
            ->toArray();
    
        // Step 2: Fetch product details using the ordered product IDs
        $products = Product::whereIn('id', $orderedProductIds)
            ->get()
            ->sortBy(function($product) use ($orderedProductIds) {
                return array_search($product->id, $orderedProductIds);
            });
    
        // Initialize arrays to store category products and pinned products
        $categoryProducts = [];
        $categoryPins = [];
    
        // Function to recursively fetch products and pinned products for categories and their children
        $fetchProducts = function ($categories) use (&$categoryProducts, &$categoryPins, &$fetchProducts) {
            foreach ($categories as $category) {
                // Initialize arrays to store products and pinned product IDs for the current category
                $categoryProducts[$category->id] = [];
                $categoryPins[$category->id] = [];
    
                foreach ($category->products as $product) {
                    // Collect product IDs and pinned product IDs
                    $categoryProducts[$category->id][] = $product->id;
                    if ($product->pivot->pinned) {
                        $categoryPins[$category->id][] = $product->id;
                    }
                }
    
                // If the category has children (subcategories), recursively fetch their products
                if ($category->children->isNotEmpty()) {
                    $fetchProducts($category->children);
                }
            }
        };
    
        // Call the function to populate $categoryProducts and $categoryPins
        $fetchProducts($categories);
    
        // Log categoryPins to verify
        Log::info('Category Pins:', $categoryPins);
    
        // Get the customer using Auth
        $customer = Auth::guard('customer')->user();
    
        // Pass data to view
        return view('admin.categories.categories-list', [
            'categories' => $categories,
            'products' => $products,
            'customer' => $customer,
            'categoryProducts' => $categoryProducts,
            'categoryPins' => $categoryPins,
        ]);
    }
    

    public function addCategory(Request $request){
        $data=[
            'pagetitle'=>'Add Category'
        ];
        return view('admin.categories.add-category',$data);
    }
    public function store(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:255',
    ]);

    $category = new Category();
    $category->category_name = $request->category_name;

    if ($request->has('parent_id')) {
        $category->parent_id = $request->parent_id; // Set parent_id if present
    }

    $category->save();

    return redirect()->back()->with('success', 'Category created successfully.');
}


public function editCategory(Request $request, $id)
{
    // Find the main category by ID
    $category = Category::findOrFail($id);

    // Load subcategories related to this category
    $subcategories = $category->children;

    // Prepare data to pass to the view
    $data = [
        'pagetitle' => 'Edit Category',
        'category' => $category,
        'subcategories' => $subcategories
    ];

    // Return the view with the data
    return view('admin.categories.edit', $data);
}

    public function updateCategory(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // Find category by ID
        $category = Category::findOrFail($id);

        // Update category
        $category->category_name = $request->category_name;
       
        $category->save();

        // Redirect back with success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Delete subcategories recursively (if applicable)
        $this->deleteSubcategories($category);

        // Now delete the category itself
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category and its subcategories deleted successfully.');
    }

    protected function deleteSubcategories($id)
    {
        try {
            // Find the category by ID
            $category = Category::findOrFail($id);
    
            // Delete the category
            $category->delete();
    
            // Optionally, return a JSON response or redirect
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return redirect()->route('categories.index')->with('error', 'Failed to delete category');
        }
    }
    public function getProducts($categoryId)
    {
        $category = Category::with('products')->findOrFail($categoryId)->take(5);
        
        // Return JSON response for products
        return response()->json([
            'category_name' => $category->category_name,
            'products' => $category->products,
        ]);
    }
    public function assignProducts(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'products' => 'required|array',
            'product.*' => 'exists:products,id', // Ensure all product IDs exist in products table
        ]);
        
        // Find the category
        $category = Category::findOrFail($id);
        
        // Get IDs of selected products
        $selectedProducts = $request->input('products');
        
        // Sync products to category
        $category->products()->sync($selectedProducts);
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Products assigned successfully');
    }
    
    public function show(Category $subcategory, Request $request)
    {
        // Determine items per page from request, default to 5 if not provided
        $itemsPerPage = $request->get('itemsPerPage', 5);
    
        // Fetch min and max price from request, default to 0 and 100 respectively if not provided
        $minPrice = $request->get('min_price', 0);
        $maxPrice = $request->get('max_price', 100);
    
        // Query products with sorting and filtering
        $query = $subcategory->products()
            ->whereBetween('price', [$minPrice, $maxPrice])
            ->orderByDesc('product_category.pinned')
            ->orderBy('product_category.position');
    
        // Paginate the results
        $products = $query->paginate($itemsPerPage);
    
        // Fetch the authenticated customer
        $customer = Auth::guard('customer')->user();
    
        // Check if the request is AJAX or regular web request
        if ($request->ajax()) {
            // If AJAX, return JSON response
            return response()->json([
                'products' => $products,
                'pagination' => (string) $products->links(), // Convert pagination links to string
            ]);
        } else {
            // If regular request, return view with products
            return view('front.list', compact('subcategory', 'products', 'customer', 'itemsPerPage'));
        }
    }
    

public function showCategories()
{
    $categories = Category::with('children')->get();
    $products = Product::all();

    $categoryProducts = [];
    foreach ($categories as $category) {
        $categoryProducts[$category->id] = $category->products->pluck('id')->toArray();
    }

    return redirect()->route('categories.index', compact('categories', 'products', 'categoryProducts'));
}
public function updatePositions(Request $request, $categoryId)
{
    try {
        $productOrder = $request->input('productOrder');
        
        foreach ($productOrder as $index => $productId) {
            DB::table('product_category')
                ->where('category_id', $categoryId)
                ->where('product_id', str_replace('product-', '', $productId))
                ->update(['position' => $index]);
        }

        return response()->json(['message' => 'Product positions updated successfully']);
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error updating product positions: ' . $e->getMessage());
        
        return response()->json(['message' => 'Error updating product positions'], 500);
    }
}


 }
