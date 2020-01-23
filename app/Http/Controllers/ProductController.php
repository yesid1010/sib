<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProductStoreRequest;
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
        $products   = Product::orderBy('id','desc')->get();

        return view('products.index',['products'=>$products,'categories'=>$categories]);
    }


    public function store(ProductStoreRequest $request)
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

        return back()->with('mensajepro','!! Producto agregado con exito!!');
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

        return back()->with('mensajepro','!! producto actualizado con exito!!');

    }

    public function destroy(Request $request)
    {
        $product =  Product::findOrFail($request->id);
        $product->delete();

        return back()->with('mensajepro','!! producto eliminado con exito!!');
    }

    public function AddProduct(Request $request){

        $product                 = Product::findOrFail($request->id);
        $product->unity          = $request->input('unity') + $product->unity;
        // $product->three_quarters = $product->three_quarters;
        // $product->half           = $product->half;
        // $product->quater         = $product->quater;
        $product->save();

        return back()->with('mensajepro','!! cantidad agregada con exito!!');
    }


        // generar pdf del stock de todos los productos
        public function pdf(){
            $products=Product::all();
    
            $pdf = \PDF::setOptions([
                'logOutputFile' => storage_path('logs/log.htm'),
                'tempDir' => storage_path('logs/')
                ])->loadView('pdf.products',['products'=>$products]);
            return $pdf->stream('stock'.now().'.pdf');
        }



}
