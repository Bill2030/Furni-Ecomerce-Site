<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view("product.index");
    }
    public function shop()
    {
        return view("product.shop");
    }
    public function about()
    {
        return view("product.about");
    }
    public function services()
    {
        return view("product.services");
    
    }
    public function blog()
    {
        return view("product.blog");
    }
    public function contact()
    {
        return view("product.contact");
    }
    public function cart()
    {
    
        return view("product.cart");
    }
}
