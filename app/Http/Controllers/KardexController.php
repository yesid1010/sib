<?php

namespace App\Http\Controllers;

use App\Kardex;
use App\Pub;
use App\Product;
use App\Order;
use App\Kardex_Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class KardexController extends Controller
{

    // mostrar todos los kardex cerrados
    public function index(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if($start_date == '' || $end_date == ''){
            $kardexs = Kardex::where('status','0')->orderBy('id','desc')->get();
            return view('kardex.index',['kardexs'=>$kardexs]);
        }else{
            $kardexs = Kardex::where('status','1')
                                ->whereBetween('date', [$start_date, $end_date])
                                ->orderBy('id','desc')->get();
            return view('kardex.index',['kardexs'=>$kardexs]);
        }

    }

    // funcion que llama al metodo store() y detail() para crear un kardex
    public function create()
    {
        $kardex = $this->store(); 

        if($kardex == null){
            alert()->error('error', '!! Aún no hay productos creados!!')->autoclose(3000);
            return back();
        }
        $this->detail($kardex->id);
        alert()->success('OK', '!! Kardex inicializado con exito!!')->autoclose(3000);;
        return back();
    }

    // funcion para crear un kardex
    public function store()
    {
        $products = Product::all();

        if(count($products)==0){
            return null;
        }else{
            $kardex = new Kardex();
            $kardex->date = Carbon::now();
            //$kardex->date = new Carbon('yesterday');
            $kardex->save();
    
            return $kardex;
        }
       
    }

    // funcion para crear los detalles de un kardex
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
            $detail->date           = $kardex->date;
            $detail->save();
            
        }

    }

    // funcion para editar el campo output_product con  todos los detalles del dia anterior
    //cerrar kardex
    public function edit()
    {
        $kardex = Kardex::all();

        $previous_date = new Carbon('yesterday') ;
        $kardex = Kardex::where('date','=',$previous_date)->first();
        $kardex->status = '1';
        $kardex->save();

        $detalles = $this->getCantidad($kardex->id);

        foreach ($detalles as $detalle) {
            $kardex_product= Kardex_Product::where('product_id','=',$detalle->product_id)
            ->where('kardex_id','=',$detalle->kardex)
            ->first();

            $kardex_product->output_product = $detalle->cantidad;

            $kardex_product->stock_end = $kardex_product->total - $kardex_product->output_product;

            $kardex_product->save();
        }
        alert()->success('OK', '!! Kardex Cerrado con exito!!')->autoclose(3000);
        return back();
    }

    //Obtener la cantidad total de cada producto vendido
    public function getCantidad($id){

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
        //$previous_date = new Carbon('yesterday') ;
        $cont = 0;
        $products = $request->input('product');
        $quantity = $request->input('quantity');

       $kardex = Kardex::where('date','=',Carbon::now()->format('Y-m-d'))->first();
      // $kardex = Kardex::where('date','=',$previous_date)->first();
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
        alert()->success('OK', '!!pedido Guardado exitosamente!!')->autoclose(3000);
       return back();
    }

   // metodo que llama a la funcion getDetalles() para mostrar
   // los detalles de un kardex en especifico
    public function shows(Request $request){
        $kardex = Kardex::findOrFail($request->id);
        $detalles = $this->getDetalles($kardex->id);
        return view('kardex.show',['detalles'=>$detalles,'kardex'=>$kardex]);
    }

    // funcion para traer los detalles de un kardex
    public function getDetalles($id){
        $detalles = DB::table('kardex_product')
                  ->join('products','products.id','=','kardex_product.product_id')
                  
                  ->where('kardex_product.kardex_id','=',$id)->get();
        return $detalles;
    }

    // funcion para mostrar como fue distribuido la cantidad gastada de un producto
    // en los diferentes bares
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

    //generar pdf de un kardex
    public function pdf($id){
        $kardex = Kardex::findOrFail($id);
        $pubs = Pub::all();
        $detalles   = $this->getDetalles($kardex->id);
        $detallesBares = $this->getPubs($kardex->id);
        $pdf = \PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
            ])->loadView('pdf.kardex',['detalles'=>$detalles,
                                        'kardex'=>$kardex,
                                        'pubs'=>$pubs,
                                        'detallesBares'=>$detallesBares])
                                        ->setPaper('a4', 'landscape');
        return $pdf->stream('kardex'.$id.'.pdf');
    }


   // devuelve los bares con la cantidad de cada producto de un kardex 
    public function getPubs($id){
        $kardex = Kardex::findOrFail($id);
        
        $detalles = DB::table('kardexes')
            ->join('orders','orders.kardex_id','=','kardexes.id')
            ->join('order_product','order_product.order_id','=','orders.id')
            ->join('products','products.id','=','order_product.product_id')
            ->join('pubs','pubs.id','=','orders.pub_id')
            ->select('products.name as producto','pubs.name as bar',
                    DB::raw('SUM(order_product.cant_unity) as cantidad'),
                    'order_product.product_id as product_id',
                    'orders.kardex_id as kardex',
                    'pubs.id as pub_id')
            ->where('orders.kardex_id','=',$kardex->id)
            ->groupBy('products.name',
                      'order_product.product_id',
                      'orders.kardex_id',
                      'pubs.name','pubs.id')
            ->orderBy('product_id')
            ->get();
        return $detalles;
    }
}
