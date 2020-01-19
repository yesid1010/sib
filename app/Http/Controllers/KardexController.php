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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kardex = $this->store(); 
        $this->detail($kardex->id);
        return back()->with('mensaje','Kardex inicializado con exito');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $kardex = new Kardex();
        $kardex->date = Carbon::now();
        $kardex->save();

        return $kardex;
       
    }

    public function detail($id_kardex){
        $products = Product::all();

        foreach($products as $product){
            $detail                 = new Kardex_Product();
            $detail->product_id     = $product->id;
            $detail->kardex_id      = $id_kardex;
            $detail->stock_ini      = $product->unity;
            $detail->input_product  = 0;
            $detail->output_product = 0;
            $detail->total          = $detail->stock_ini + $detail->input_product ;
            $detail->stock_end      = 0;
            $detail->date           = Carbon::now();
            $detail->save();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function show(Kardex $kardex)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $previous_date = new Carbon('yesterday') ;
        $kardex = Kardex::where('date','=',$previous_date)->first();
        $kardex->status = '1';
        $kardex->save();

        $orders = $this->getOrder($kardex->id);
       
        foreach ($orders as $order ) {
            $detalles = $this->getDetail($order->id);
            foreach ($detalles as $detalle) {

                echo $detalle->product_id.' '.$detalle->unity.' => ';
            }
        }

    }

    public function getOrder($id){
        $orders = Order::where('kardex_id','=',$id)->get();
        return $orders;
    }

    //Obtener los detalles de una orden
    public function getDetail($id){
        $detalles = DB::table('orders')
                ->join('order_product','order_product.order_id','=','orders.id')
                ->join('products','products.id','=','order_product.product_id')
                ->select('products.id as product_id','products.name as product_name',
                        'order_product.cant_unity as unity','order_product.id as id')
                ->where('orders.id','=',$id)
                ->get();

        return $detalles;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $cont = 0;
        $products = $request->input('product');
        $quantity = $request->input('quantity');

        $kardex = Kardex::where('date','=',Carbon::now()->format('Y-m-d'))->first();
        
        while($cont < count($products)){
            $product = Product::findOrFail($products[$cont]);
            $detail= Kardex_Product::where('product_id','=',$products[$cont])
                                    ->where('kardex_id','=',$kardex->id)
                                    ->first();
                                    
            $detail->input_product = $detail->input_product + $quantity[$cont];
            $detail->total = $detail->stock_ini + $detail->input_product;
            $detail->save();
            $product->unity = $detail->total;
            $product->save();
            $cont++;

        }

       return bact()->with('mensaje','pedido Guardado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kardex $kardex)
    {
        //
    }
}
