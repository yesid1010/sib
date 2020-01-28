<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\Pub;
use App\User;
use App\Kardex;
use App\Order_Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

// mostrar los datos necesarios para ver una orden especifica y para crearla
    public function index(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if($start_date == '' && $end_date == ''){
            $orders = DB::table('orders')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('pubs','pubs.id','=','orders.pub_id')
                    ->select('users.id as user_id','users.names as nameU',
                            'pubs.id as pub_id','pubs.name as nameP',
                            'orders.id as id',
                            'orders.description as description',
                            'orders.status as status',
                            'orders.created_at as created_at')
                    ->orderBy('id', 'desc')
                    ->get();
        }else{
            $orders = DB::table('orders')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('pubs','pubs.id','=','orders.pub_id')
                    ->join('kardexes','kardexes.id','=','orders.kardex_id')
                    ->select('users.id as user_id','users.names as nameU',
                            'pubs.id as pub_id','pubs.name as nameP',
                            'orders.id as id',
                            'orders.description as description',
                            'orders.status as status',
                            'orders.created_at as created_at')
                    ->whereBetween('kardexes.date', [$start_date, $end_date])
                    ->orderBy('id', 'desc')
                    ->get();

        }

        $products = Product::all()->where('unity','>',0);
        $pubs     = Pub::all();
        $users    = User::where([
                                  ['role_id','=','3'],
                                  ['status','=','ENABLED'],
                                ])->get();

        return view('orders.index',['orders'    => $orders,
                                    'products'  => $products,
                                    'pubs'      => $pubs,
                                    'users'     => $users]
                    );
    }

// metodo para crear una nueva orden
    public function store(Request $request){
        // $previous_date = new Carbon('yesterday') ;
        // $kardex = Kardex::where('date','=',$previous_date)->first();

        
        $kardex = Kardex::where('date','=',Carbon::now()->format('Y-m-d'))->first();
        $order              = new Order();
        $order->user_id     = $request->input('user_id');
        $order->pub_id      = $request->input('pub_id');
        $order->description = $request->input('description');
        $order->idadmin     = Auth::user()->id;
        $order->kardex_id   = $kardex->id;
        $order->save();

        $cont = 0;
        $products = $request->input('product');
        $quantity = $request->input('quantity');
        // $cant_half = $request->input('cant_half');
        // $cant_quater = $request->input('cant_quater');
        // $cant_three_quarters = $request->input('cant_three_quarters');


        while($cont < count($products)){
            $detalle                        =  new Order_product();
            $detalle->order_id              = $order->id;
            $detalle->product_id            = $products[$cont];
            $detalle->cant_unity            = $quantity[$cont];
            // $detalle->cant_half             = $cant_half[$cont];
            // $detalle->cant_quater           = $cant_quater[$cont];
            // $detalle->cant_three_quarters   = $cant_three_quarters[$cont];

            //disminuir stock de este producto
            $this->disStock($detalle->product_id,$detalle->cant_unity);
            $detalle->save();

            $cont++;

        }
        alert()->success('OK', '!!Orden Agregada con exito!!')->autoclose(3000);
        return back();
    }

    // mostrar los detalles de una orden en especifico
    public function DetailOrden(Request $request){

        $order   = $this->getOrder($request->input('id'));
        $pub     = $this->getPub($request->input('id'));
        $detalles = $this->getDetail($request->input('id'));
        
        $products = Product::all()->where('unity','>',0);

        return view('orders.show',['order'=>$order,
                    'detalles'=>$detalles,
                    'products'=>$products,
                    'pub'=>$pub]);
    }


    // eliminar un producto de una orden 
    public function destroy(Request $request){
        $order_product = Order_product::findOrFail($request->id);
        
        $product = Product::findOrFail($order_product->product_id);

        $product->unity = $product->unity + $order_product->cant_unity;

        $product->save();
        
        $order_product->delete();
        alert()->success('OK', '!!Producto  eliminado con exito!!')->autoclose(3000);
        return back();
    }

// agregar un producto a una orden creada
    public function Addproduct(Request $request){

        $product_id = $request->input('product_id'); 
        $quantity   = $request->input('quantity');

        $product = Product::findOrFail($product_id);

        if($quantity > $product->unity){
            alert()->error('error', '!! La cantidad  supera el stock!!')->autoclose(3000);
            return back();
        }else{

            $order_product = new Order_Product();
            $order_product->order_id = $request->input('id');
            $order_product->product_id = $product_id; 
            $order_product->cant_unity = $quantity;
    
            $this->disStock($product_id,$quantity);
    
            $order_product->save();
            alert()->success('OK', '!!Producto Agregado con exito!!')->autoclose(3000);
            return back();

        }
    }


    // editar la cantidad de un producto de cierta orden
    public function EditDetailOrder(Request $request){

        
        $order_product = Order_Product::findOrFail($request->id);
        $cant_nueva    = $request->cantProduct;

        $total = $cant_nueva + $order_product->cant_unity;

        $product = Product::findOrFail($order_product->product_id);

        if($total > $product->unity){
            alert()->error('error', '!! La cantidad  supera el stock!!')->autoclose(3000);
            return back();
        }else{
            $order_product->cant_unity =  $order_product->cant_unity + $cant_nueva;
            $order_product->save();
    
           // $product = Product::findOrFail($order_product->product_id);
    
            $product->unity = $product->unity - $cant_nueva;
    
            $product->save();
            alert()->success('OK', '!!Cantidad Actualizada con exito!!')->autoclose(3000);
            return back();
        }
    }

    // cambiar de estado
    public function Status(Request $request){
        $order          = Order::findOrFail($request->id);
        $order->status  = '0';
        
        $order->save();
        alert()->success('OK', '!!Orden Cerrada con exito!!')->autoclose(3000);
        return back();
    }

    public function update(Request $request)
    {
        //
        $order              =  Order::findOrFail($request->id);
        $order->user_id     = $request->input('user_id');
        $order->pub_id     = $request->input('pub_id');
        $order->description = $request->input('description');

        
        $order->save();
        alert()->success('OK', '!!Orden Actualizada con exito!!')->autoclose(3000);
        return back();
    }

    // generar pdf de una orden 
    public function pdf($id){
        $order   = $this->getOrder($id);
        $user    = $this->getUser($id);
        $pub     = $this->getPub($id);
        $admin   = $this->getAdmin($id);
        $details = $this->getDetail($id);

        $pdf = \PDF::setOptions([
            'logOutputFile' => storage_path('logs/log.htm'),
            'tempDir' => storage_path('logs/')
            ])->loadView('pdf.orders',['order'=>$order,
                                       'user'=>$user,
                                       'pub'=>$pub,
                                       'admin'=>$admin,
                                       'details'=>$details
                                       ]);
        return $pdf->stream('orden'.$id.'.pdf');
    }

    //Obtener una orden
    public function getOrder($id){
        $order =  Order::findOrFail($id);
        return $order;
    }

    //Obtener el usuario barman que mandaron para una orden
    public function getUser($id){
        $user = DB::table('users')
                    ->join('orders','orders.user_id','=','users.id')
                    ->where('orders.id','=',$id)
                    ->first();
        return $user;
    }

    //Obtener el usuario admin que creó una orden
    public function getAdmin($id){
        $admin = DB::table('users')
                    ->join('orders','orders.idadmin','=','users.id')
                    ->where('orders.id','=',$id)
                    ->first();
        return $admin;
    }

    //Obtener el bar de una orden
    public function getPub($id){
        $pub = DB::table('pubs')
                    ->join('orders','orders.pub_id','=','pubs.id')
                    ->where('orders.id','=',$id)
                    ->first();
        return $pub;
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

    public function OrderBarman(Request $request){
        $user = User::findOrFail($request->id);
        $orders   = DB::table('orders')
        ->join('users','users.id','=','orders.user_id')
        ->join('pubs','pubs.id','=','orders.pub_id')
        ->select('users.id as user_id','users.names as nameU',
                 'pubs.name as nameP',
                 'orders.id as id',
                 'orders.description as description',
                 'orders.status as status',
                 'orders.created_at as created_at')
        ->orderBy('id', 'desc')
        ->where('user_id','=',$user->id)
        ->get();
        
        return view('users.barmans.orders',['orders'=>$orders,'user'=>$user]);
    }

//funcion para disminuir el stock de un producto agregado a una orden
    public function disStock($id,$cant){
        $product = Product:: findOrFail($id);

        $product->unity = $product->unity - $cant;

        $product->save();

        return $product;
    }
}
