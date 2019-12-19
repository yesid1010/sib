<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        $pubs = Pub::all();
        return view('pubs.index',['pubs'=>$pubs]);
    }

    public function store(Request $request)
    {
        //
        $pub              = new Pub();
        $pub->name        = $request->input('name');
        $pub->description = $request->input('description');
        $pub->save();
        return Redirect::to('pubs');
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
        $pub->save();
        return Redirect::to('pubs');
    }

    public function destroy( $id )
    {
        $pub =  Pub::findOrFail($id);
        $pub->delete();
        return Redirect::to('pubs');
    }
}
