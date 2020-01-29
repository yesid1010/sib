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

        $isfirst=false;
        $empty = false;

        if(count($kardexs) == 0){
            $empty=true;
        }

        if(count($kardexs) == 1){
            $isfirst=true;
        }



        $last_state = $this->getUltimoKardex();
        

        
        return view('home.index',['products'=>$products,
                                  'kardexs'=>$kardexs,
                                   'today'=>$today,
                                   'last_state'=>$last_state,
                                   'isfirst'=>$isfirst,
                                   'empty'=>$empty]);
    }

    public function getUltimoKardex(){


        $date = new Carbon('yesterday');
        $kardex = Kardex::where('date','=',$date)->first();

        if($kardex == null){
            return 2;
        }else {
            return $kardex->status;
        }

       


    //     $kardexs = Kardex::all();

    //     $date = Carbon::now()->format('Y-m-d');
    //     $kardex = Kardex::where('date','=',$date)->first();
    //     if(count($kardexs) == 1 && $kardex != null ){
    //         //$date = Carbon::now()->format('Y-m-d');
    //         return 0;
    //     }else{
    //         // $date = new Carbon('yesterday');
    //         return 1;
    //     }


    //    // $previous_date = new Carbon('yesterday') ;
    //     // $kardex = Kardex::where('date','=',$date)->first();
    //     // return $kardex->status;
    }
}
