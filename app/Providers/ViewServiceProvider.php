<?php

namespace App\Providers;



    use Illuminate\Support\ServiceProvider;
    use Illuminate\Support\Facades\View;
    use Illuminate\Support\Facades\DB;
    use App\Models\Category;
    use Illuminate\Support\Facades\Auth;
    
    class ViewServiceProvider extends ServiceProvider
    {
        /**
         * Register any application services.
         *
         * @return void
         */
        public function register()
        {
            //
        }
    
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            // Using a closure based composer...
            View::composer('*', function ($view) {
                $product = DB::table('product')->orderBy('created_at', 'asc')->take(5)->get();
                $new = DB::table('product')->orderBy('created_at', 'desc')->take(5)->get();
                $categories = Category::whereNull('parent_id')->with('children')->get();
                $customer = Auth::guard('customer')->user();
    
                $view->with('product', $product)
                     ->with('new', $new)
                     ->with('categories', $categories)
                     ->with('customer', $customer);
            });
        }
    }
    

