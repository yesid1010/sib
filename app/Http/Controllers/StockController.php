<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\Pub;
use App\Product;

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
        $stock->name = $request->input('description');
        $stock->pub_id = $request->input('pub_id');

        // aun falta aqui cosas

    }
}
