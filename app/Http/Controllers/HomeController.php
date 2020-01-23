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
        $fecha =  Carbon::now()->format('Y-m-d');
        return view('home.index',['products'=>$products,'kardexs'=>$kardexs,'fecha'=>$fecha]);
    }
}
