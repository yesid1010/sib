<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\Pub;
use App\Product;
use App\Product_Stock;

class StockController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    // mostrar todos los productos y los bares 
    // y mandarlos a vista index
    public function index(){
        $stocks   = DB::table('stocks')
                    ->join('pubs','pubs.id','=','stocks.pub_id')
                    ->select('pubs.name as name',
                            'stocks.description as description',
                            'stocks.id as id',
                            'stocks.pub_id as pub_id')
                    ->get();
        
        $products = Product::all();
        $pubs     = Pub::all();

        return view('stocks.index',['stocks'=>$stocks,'products'=>$products,'pubs'=>$pubs]);
    }

    // crear un stock ideal para un bar
    public function store(Request $request){
        $stock = new Stock();
        $stock->description = $request->input('description');
        $stock->pub_id = $request->input('pub_id');

        $stock->save();

        $cont = 0;
        $products = $request->input('product');
        $quantity = $request->input('quantity');

        while($cont < count($products)){

            $product_stock = new Product_Stock();
            $product_stock->stock_id = $stock->id;
            $product_stock->product_id = $products[$cont];
            $product_stock->cant_unity = $quantity[$cont];

            $product_stock->save();
            $cont++;
        }

        return redirect('stocks');;
    }

    // mostrar los detalles de un stock ideal de cierto bar
    public function detailStock(Request $request){
        $stock   = DB::table('stocks')
        ->join('pubs','pubs.id','=','stocks.pub_id')
        ->select('pubs.name as name',
                'stocks.description as description',
                'stocks.id as id',
                'stocks.pub_id as pub_id'
                )
        ->where('stocks.id','=',$request->input('id'))
        ->first();

        $detalles = DB::table('stocks')
                      ->join('product_stocks','product_stocks.stock_id','=','stocks.id')
                      ->join('products','products.id','=','product_stocks.product_id')
                      ->select('products.name as name',
                               'product_stocks.cant_unity as quantity',
                               'product_stocks.id as id')
                      ->where('stocks.id','=',$request->input('id'))
                      ->get();

        $products = Product::all();
        return view('stocks.show',['stock'=>$stock,
                                   'detalles'=>$detalles,
                                   'products'=>$products]);
    }


    // editar la cantidad del stock ideal de cierto producto
    public function EditDetail(Request $request){
        $product_stock = Product_Stock::findOrFail($request->id);
        $product_stock->stock_id =  $product_stock->stock_id;
        $product_stock->product_id =  $product_stock->product_id;
        $product_stock->cant_unity =  $request->input('cantProduct');

        $product_stock->save();

        return back();
    }


    // eliminar un producto de un stock ideal de cierto bar
    public function destroy($id){
        $product_stock = Product_Stock::findOrFail($id);
        $product_stock->delete();

        return back();
    }

    public function addproduct(Request $request){
        $product_stock = new Product_Stock();
        $product_stock->stock_id = $request->input('id');
        $product_stock->product_id = $request->input('product_id'); 
        $product_stock->cant_unity = $request->input('quantity'); 

        $product_stock->save();
        return back();
    }
}
