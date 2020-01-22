<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PubStoreRequest;
use App\Pub;

class PubController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $pubs = Pub::orderBy('id','desc')->get();
        return view('pubs.index',['pubs'=>$pubs]);
    }

    public function store(PubStoreRequest $request)
    {
        //
        $pub              = new Pub();
        $pub->name        = $request->input('name');
        $pub->description = $request->input('description');
        $pub->category    = $request->input('category');
        $pub->save();
        return back()->with('mensajepub','!! Bar agregado con exito!!');
    }


    public function show(pub $pub)
    {
        //
    }

    public function update(Request $request)
    {
        //
        $pub              =  Pub::findOrFail($request->id);
        $pub->name        = $request->input('name');
        $pub->description = $request->input('description');
        $pub->category    = $request->input('category');
        $pub->save();
        return back()->with('mensajepub','!! Bar actualizado con exito!!');
    }

    public function destroy( Request $request )
    {
        $pub =  Pub::findOrFail($request->id);
        $pub->delete();
        return back()->with('mensajepub','!! Bar Eliminado con exito!!');
    }

    public function OrderPub(Request $request){
        $pub = Pub::findOrFail($request->id);
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
        ->where('pub_id','=',$pub->id)
        ->get();
        return view('pubs.orders',['orders'=>$orders]);
    }
}
