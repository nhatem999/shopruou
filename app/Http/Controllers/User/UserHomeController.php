<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller
{
    //
    function __construct()
    {
    }
    function index()
    {

        $sliders = Slider::where('status', 1)->latest()->get();
        $products = Product::where('featured', 1)->where('status', 1)->latest()->take(8)->get();
        //Product Rượu vang
        $catChildRuouVodka = CategoryProduct::where('parent_id', function ($query) {
            $query->select('id')->from('category_products')->where('slug', '=', 'ruou-vang');
        })->get();
        foreach ($catChildRuouVodka as $item) {
            $catRuouVodkaIds[] = $item->id;
        }
        $productRuouVodka = Product::whereIn('category_product_id', $catRuouVodkaIds)->where('status', 1)->latest()->take(8)->get();

        //Product Rượu vang
        $catChildRuouPhap = CategoryProduct::where('parent_id', function ($query) {
            $query->select('id')->from('category_products')->where('slug', '=', 'ruou-vang');
        })->get();
        foreach ($catChildRuouPhap as $item) {
            $catRuouPhapIds[] = $item->id;
        }
        $productRuouPhap = Product::whereIn('category_product_id', $catRuouPhapIds)->where('status', 1)->latest()->take(8)->get();
        //Product Rượu tết
        $catChildRuouTet = CategoryProduct::where('parent_id', function ($query) {
            $query->select('id')->from('category_products')->where('slug', '=', 'ruou-tet');
        })->get();
        foreach ($catChildRuouTet as $item) {
            $catRuouTetIds[] = $item->id;
        }
        $productRuouTet = Product::whereIn('category_product_id', $catRuouTetIds)->where('status', 1)->latest()->take(8)->get();
      

        return view('user.index', compact('sliders', 'products', 'productRuouPhap','productRuouTet','productRuouVodka'));
    }

    function page($id)
    {
        $page = Page::find($id);
        return view('user.page', compact('page'));
    }
}
