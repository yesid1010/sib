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
}
