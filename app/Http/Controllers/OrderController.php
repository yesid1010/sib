<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\Pub;
use App\User;
use App\Order_Product;
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
    public function index(){
        $orders   = DB::table('orders')
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
        $order              = new Order();
        $order->user_id     = $request->input('user_id');
        $order->pub_id      = $request->input('pub_id');
        $order->description = $request->input('description');
        $order->idadmin     = Auth::user()->id;
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

            $detalle->save();

            $cont++;

        }

        return back()->with('mensajesorder','!! Orden Agregada con exito!!');
    }

    public function DetailOrden(Request $request){

        $order   = $this->getOrder($request->input('id'));
        $pub     = $this->getPub($request->input('id'));
        $detalles = $this->getDetail($request->input('id'));
        
        $products = Product::all();

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

        return back()->with('mensajesorder','!! Producto eliminado con exito!!');
    }


    public function Addproduct(Request $request){
        $order_product = new Order_Product();
        $order_product->order_id = $request->input('id');
        $order_product->product_id = $request->input('product_id'); 
        $order_product->cant_unity = $request->input('quantity'); 

        $order_product->save();
        return back()->with('mensajesorder','!! producto Agregado con exito!!');
    }


    // editar la cantidad de un producto de cierta orden
    public function EditDetailOrder(Request $request){
        $order_product = Order_Product::findOrFail($request->id);

        $cant_anterior = $request->id_an;
        $cant_nueva    = $request->cantProduct;

        $order_product->cant_unity =  $cant_nueva;
        $order_product->save();

        $product = Product::findOrFail($order_product->product_id);

        $stockAntiguo = $product->unity;

        $stockNuevo = $stockAntiguo + $cant_anterior - $cant_nueva;

        $product->unity = $stockNuevo;

        $product->save();

        return back()->with('mensajesorder','!! Cantidad actualizada con exito!!');
    }

    // cambiar de estado
    public function Status($id){
        $order          = Order::findOrFail($id);
        $order->status  = '0';
        
        $order->save();
        return back()->with('mensajesorder','!! Estado Actualizado con exito!!');
    }

    public function update(Request $request)
    {
        //
        $order              =  Order::findOrFail($request->id);
        $order->user_id     = $request->input('user_id');
        $order->pub_id     = $request->input('pub_id');
        $order->description = $request->input('description');

        
        $order->save();
        return back()->with('mensajesorder','!! Orden actualizada con exito!!');
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
        
        return view('users.barmans.orders',['orders'=>$orders]);
    }
}
