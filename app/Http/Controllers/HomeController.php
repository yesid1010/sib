<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Kardex;
use Carbon\Carbon;
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
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        
        $products = Product::all();
        $kardexs = Kardex::all();
        $today =  Carbon::now()->format('Y-m-d');
        $last_state = $this->getUltimoKardex();
        
        return view('home.index',['products'=>$products,
                                  'kardexs'=>$kardexs,
                                   'today'=>$today,
                                   'last_state'=>$last_state]);
    }

    public function getUltimoKardex(){
        $previous_date = new Carbon('yesterday') ;
        $kardex = Kardex::where('date','=',$previous_date)->first();
        return $kardex->status;
    }
}
