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


    public function index(){
        $orders   = DB::table('orders')
                    ->join('users','users.id','=','orders.user_id')
                    ->join('pubs','pubs.id','=','orders.pub_id')
                    ->select('users.names as nameU',
                             'pubs.name as nameP',
                             'orders.id as id',
                             'orders.description as description',
                             'orders.created_at as created_at')
                    ->get();

        $products = Product::all();
        $pubs     = Pub::all();
        $users    = User::all()->where('role_id',3);
        return view('orders.index',['orders'    => $orders,
                                    'products'  => $products,
                                    'pubs'      => $pubs,
                                    'users'     => $users]
                    );
    }

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
}
