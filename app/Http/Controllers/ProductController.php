<?php

namespace App\Http\Controllers;

use Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return view("product.index");
    }
    public function shop()
    {
        $products = Product::all();
        return view("product.shop", compact('products'));
    }
    public function about()
    {
        return view("product.about");
    }
    public function services()
    {
        $products = Product::all();
        return view("product.services", compact('products'));
    
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
        
        $subtotals = \Cart::getSubTotal();
        $totals = \Cart::getTotal();
        $items = \Cart::getContent();
        return view("product.cart", compact('items', 'totals', 'subtotals'));
    }


public function create()
{
    return view("product.create");

}
public function store(Request $request)
{
    $formFields = $request->validate([
      
        'name' => 'required',
        'price' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',   
    ]);

    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images'), $imageName);
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->image = 'images/'.$imageName;
    $product->save();
    return redirect()->route('products.index')->with('success', 'Product created successfully.');
    
    
}

public function addcart($productId)
{
    $product = Product::findOrFail($productId);

    // add the product to cart
\Cart::add(array(
    'id' => $productId,
    'name' => $product->name,
    'price' => $product->price,
    'quantity' => 1,
    'attributes' => array(
        'image'=>$product->image
    ),
    'associatedModel' => $product
));
return redirect()->route('products.cart')->with('success', 'Products added successfully');

}

public function addquantity($productId)
{
    \Cart::update($productId,[
        
        'quantity' => +1,
    ]);
    return back()->with('success', 'Quantity Added successfully');
}

 public function decreasequantity($productId)
 {
    \Cart::update($productId,[
        
        'quantity'=>-1,
        
    ]);
    return back()->with('success', 'Quantity reduced successfully');
}

public function removeitem($productId)
{
    \Cart::remove($productId);
    return back()->with('success', 'Quantity has been removed from cart');
}

public function clearcart()
{
    \Cart::clear();

    return back()->with('success', 'Cart has been cleared successfully');

}

}
