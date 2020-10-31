<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     * return all product list
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productData = Product::with('getCategory:id,category_name,category_code')->paginate(5);
        return view('home',compact('productData'));
    }
}
