<?php

namespace App\Providers;

use App\Cart;
use App\ProductType;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('header',function ($view) {
            $product_type = ProductType::all();

            $view->with('product_type',$product_type);

        });
        view()->composer('header',function ($view) {
            if (Session('cart')) {
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart')
                    ,'product_cart' => $cart->items,
                'totalPrice'=>$cart->totalPrice,
                'totalQy'=>$cart->totalQty]);
            }

        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
