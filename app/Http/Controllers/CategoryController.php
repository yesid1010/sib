<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Category;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::all();
        return view('categories.index',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        //
        $category              = new Category;
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return Redirect::to('categories');
    }

    public function update(Request $request)
    {
        //
        $category              =  Category::findOrFail($request->id);
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return Redirect::to('categories');
    }

    public function destroy( $id )
    {
        $category =  Category::findOrFail($id);
        $category->delete();
        return Redirect::to('categories');
    }
}
