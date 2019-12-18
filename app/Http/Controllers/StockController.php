<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Stock;
use App\Pub;

class StockController extends Controller
{
    //
    public function index(){
        $stocks = Stock::all();
        return view('stocks.index',['stocks'=>$stocks]);
    }

    public function store(Request $request){
        $stock = new Stock();
        $stock->name = $request->input('description');
        $stock->pub_id = $request->input('pub_id');

        // aun falta aqui cosas

    }
}
