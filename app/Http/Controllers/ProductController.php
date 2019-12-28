<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Product;
use App\Category;
class ProductController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $categories = Category::all();
        $products   = Product::all();

        return view('products.index',['products'=>$products,'categories'=>$categories]);
    }


    public function store(Request $request)
    {
        //
        $product = new Product();
        $product->name           = $request->input('name');
        $product->unity          = $request->input('unity');
        // $product->three_quarters = $request->input('three_quarters');
        // $product->half           = $request->input('half');
        // $product->quater         = $request->input('quater');
        $product->category_id    = $request->input('category_id');
 
        $product->save();

        return Redirect::to('products');
    }

    public function update(Request $request)
    {
        //
        $product                 =  Product::findOrFail($request->id);

        $product->name           = $request->input('name');
        $product->unity          = $request->input('unity');
        // $product->three_quarters = $request->input('three_quarters');
        // $product->half           = $request->input('half');
        // $product->quater         = $request->input('quater');
        $product->category_id    = $request->input('category_id');

        $product->save();

        return Redirect::to('products');

    }

    public function destroy($id)
    {
        //
        $product =  Product::findOrFail($id);
        $product->delete();
        return Redirect::to('products');
    }

    public function AddProduct(Request $request){

        $product                 = Product::findOrFail($request->id);
        $product->name           = $product->name;
        $product->unity          = $request->input('unity') + $product->unity;
        // $product->three_quarters = $product->three_quarters;
        // $product->half           = $product->half;
        // $product->quater         = $product->quater;
        $product->category_id    = $product->category_id;

        $product->save();

        return redirect('products');
    }



}
