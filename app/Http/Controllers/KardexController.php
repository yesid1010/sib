<?php

namespace App\Http\Controllers;

use App\Kardex;
use App\Product;
use App\Order;
use App\Kardex_Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class KardexController extends Controller
{

    public function index()
    {
        //
        $kardexs = Kardex::where('status','1')->get();


        return view('kardex.index',['kardexs'=>$kardexs]);
    }

    // funcion que llama al metodo store() y detail() para crear un kardex
    public function create()
    {
        $kardex = $this->store(); 
        $this->detail($kardex->id);
        return back()->with('mensaje','Kardex inicializado con exito');
    }

    // funcion para crear un kardex
    public function store()
    {
        $kardex = new Kardex();
        $kardex->date = Carbon::now();
        //$kardex->date = new Carbon('yesterday');
        $kardex->save();

        return $kardex;
       
    }

    // funcion para crear los detalles de un cardex dependiendo el kardex_id
    public function detail($id_kardex){
        $products = Product::all();
        $kardex  = Kardex::findOrFail($id_kardex);

        foreach($products as $product){
            $detail                 = new Kardex_Product();
            $detail->product_id     = $product->id;
            $detail->kardex_id      = $kardex->id;
            $detail->stock_ini      = $product->unity;
            $detail->input_product  = 0;
            $detail->output_product = 0;
            $detail->total          = $detail->stock_ini + $detail->input_product;
            $detail->stock_end      = $detail->total - $detail->output_product ;
            //$detail->date           = Carbon::now();
            $detail->date           = $kardex->date;
            $detail->save();
            
        }

    }

    // funcion para editar el campo output_product de todos los detalles del dia anterior
    public function edit()
    {
        $previous_date = new Carbon('yesterday') ;
        $kardex = Kardex::where('date','=',$previous_date)->first();
        $kardex->status = '1';
        $kardex->save();

        $detalles = $this->getDetail($kardex->id);

        foreach ($detalles as $detalle) {
            $kardex_product= Kardex_Product::where('product_id','=',$detalle->product_id)
            ->where('kardex_id','=',$detalle->kardex)
            ->first();

            $kardex_product->output_product = $detalle->cantidad;

            $kardex_product->stock_end = $kardex_product->total - $kardex_product->output_product;

            $kardex_product->save();
        }

       return $detalles;
    }

    //Obtener la cantidad total de cada producto vendido
    public function getDetail($id){

        $detalles = DB::table('kardexes')
                 ->join('orders','orders.kardex_id','=','kardexes.id')
                 ->join('order_product','order_product.order_id','=','orders.id')
                 ->join('products','products.id','=','order_product.product_id')
                 ->select('products.name as producto',
                           DB::raw('SUM(order_product.cant_unity) as cantidad'),
                           'order_product.product_id as product_id',
                           'orders.kardex_id as kardex')
                 ->where('orders.kardex_id','=',$id)
                 ->groupBy('products.name','order_product.product_id','orders.kardex_id')
                 ->get();

        return $detalles;
    }

    // metodo para crear el pedido diario de los productos
    public function update(Request $request)
    {
        $previous_date = new Carbon('yesterday') ;
        $cont = 0;
        $products = $request->input('product');
        $quantity = $request->input('quantity');

       // $kardex = Kardex::where('date','=',Carbon::now()->format('Y-m-d'))->first();
       $kardex = Kardex::where('date','=',$previous_date)->first();
        while($cont < count($products)){
            $product = Product::findOrFail($products[$cont]);
            $detail= Kardex_Product::where('product_id','=',$products[$cont])
                                    ->where('kardex_id','=',$kardex->id)
                                    ->first();
                                    
            $detail->input_product = $detail->input_product + $quantity[$cont];
            $detail->total = $detail->stock_ini + $detail->input_product;
            $detail->stock_end = $detail->total - $detail->output_product;
            $detail->save();
            $product->unity = $detail->total;
            $product->save();
            $cont++;

        }

       return back()->with('mensaje','pedido Guardado exitosamente');
    }


    public function shows(Request $request){
        $kardex = Kardex::findOrFail($request->id);
        $detalles = $this->getDetalles($kardex->id);


        return view('kardex.show',['detalles'=>$detalles,'kardex'=>$kardex]);
    }


    public function getDetalles($id){
        $detalles = DB::table('kardex_product')
                  ->join('products','products.id','=','kardex_product.product_id')
                  
                  ->where('kardex_product.kardex_id','=',$id)->get();
        return $detalles;
    }


    public function distribution(Request $request){

        $product = Product::findOrFail($request->product_id);
        $kardex = Kardex::findOrFail($request->kardex_id);
        
        $detalles = DB::table('kardexes')
        ->join('orders','orders.kardex_id','=','kardexes.id')
        ->join('order_product','order_product.order_id','=','orders.id')
        ->join('products','products.id','=','order_product.product_id')
        ->join('pubs','pubs.id','=','orders.pub_id')
        ->select('products.name as producto','pubs.name as bar',
                  DB::raw('SUM(order_product.cant_unity) as cantidad'),
                  'order_product.product_id as product_id',
                  'orders.kardex_id as kardex')
        ->where('orders.kardex_id','=',$kardex->id)
        ->where('products.id','=',$product->id)
        ->groupBy('products.name','order_product.product_id','orders.kardex_id','pubs.name')
        ->get();

        return view('kardex.pubs',['detalles'=>$detalles,'kardex'=>$kardex]); 
        
    }
}
