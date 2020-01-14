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

        return redirect('orders');
    }

    public function DetailOrden(Request $request){

        $order   = $this->getOrder($request->input('id'));
        //$user    = $this->getUser($request->input('id'));
        $pub     = $this->getPub($request->input('id'));

        // $order   = DB::table('pubs')
        //             ->join('orders','orders.pub_id','=','pubs.id')
        //             ->join('users','users.id','=','orders.user_id')
        //             ->select('pubs.id as pub_id','pubs.name as nameP',
        //                     'orders.description as description',
        //                     'orders.id as id','orders.pub_id as pub_id',
        //                     'users.id as user_id','users.names as user_name','users.identification as identification',
        //                     'users.surnames as surnames',
        //                     'orders.status as status','orders.created_at as created_at'
        //                     )
        //             ->where('orders.id','=',$request->input('id'))
        //             ->first();

        $detalles = $this->getDetail($request->input('id'));
        
        $products = Product::all();
        return view('orders.show',['order'=>$order,
                    'detalles'=>$detalles,
                    'products'=>$products,
                    'pub'=>$pub]);
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
        $order_product->cant_unity =  $request->input('cantProduct');

        $order_product->save();
        return back();
    }

    // cambiar de estado
    public function Status($id){
        $order          = Order::findOrFail($id);
        $order->status  = '0';
        
        $order->save();
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
        return back();
    }


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


    public function getOrder($id){
        $order =  Order::findOrFail($id);
        return $order;
    }

    public function getUser($id){
        $user = DB::table('users')
                    ->join('orders','orders.user_id','=','users.id')
                    ->where('orders.id','=',$id)
                    ->first();
        return $user;
    }

    public function getAdmin($id){
        $admin = DB::table('users')
                    ->join('orders','orders.idadmin','=','users.id')
                    ->where('orders.id','=',$id)
                    ->first();
        return $admin;
    }

    public function getPub($id){
        $pub = DB::table('pubs')
                    ->join('orders','orders.pub_id','=','pubs.id')
                    ->where('orders.id','=',$id)
                    ->first();
        return $pub;
    }

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
}
