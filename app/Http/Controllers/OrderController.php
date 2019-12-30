<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\Pub;
use App\User;
use App\Order_Product;
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
                    ->select('users.names as nameU',
                             'pubs.name as nameP',
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

        return redirect('orders');
    }

    public function DetailOrden(Request $request){

        $order   = DB::table('pubs')
                    ->join('orders','orders.pub_id','=','pubs.id')
                    ->join('users','users.id','=','orders.user_id')
                    ->select('pubs.id as pub_id','pubs.name as nameP',
                            'orders.description as description',
                            'orders.id as id','orders.pub_id as pub_id',
                            'users.id as user_id','users.names as user_name','users.identification as identification',
                            'users.surnames as surnames',
                            'orders.status as status','orders.created_at as created_at'
                            )
                    ->where('orders.id','=',$request->input('id'))
                    ->first();

        $detalles = DB::table('orders')
                ->join('order_product','order_product.order_id','=','orders.id')
                ->join('products','products.id','=','order_product.product_id')
                ->select('products.id as product_id','products.name as product_name',
                        'order_product.cant_unity as unity','order_product.id as id')
                ->where('orders.id','=',$request->input('id'))
                ->get();
        
        $products = Product::all();
        return view('orders.show',['order'=>$order,
                    'detalles'=>$detalles,
                    'products'=>$products]);
    }


    // eliminar un producto de una orden 
    public function destroy($id){
        $order_product = Order_product::findOrFail($id);
        $order_product->delete();

        return back();
    }


    public function Addproduct(Request $request){
        $order_product = new Order_Product();
        $order_product->order_id = $request->input('id');
        $order_product->product_id = $request->input('product_id'); 
        $order_product->cant_unity = $request->input('quantity'); 

        $order_product->save();
        return back();
    }


    // editar la cantidad de un producto de cierta orden
    public function EditDetailOrder(Request $request){
        $order_product = Order_Product::findOrFail($request->id);
        $order_product->order_id =  $order_product->order_id;
        $order_product->product_id =  $order_product->product_id;
        $order_product->cant_unity =  $request->input('cantProduct');

        $order_product->save();

        return back();
    }

    // cambiar de estado
    public function Status($id){
        $order = Order::findOrFail($id);
        $order->user_id     = $order->user_id ;
        $order->pub_id      = $order->pub_id;
        $order->description = $order->description;
        $order->status      = '0';

        $order->save();

        return back();
    }
}
