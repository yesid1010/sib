<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoryStoreRequest;
use App\Category;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('categories.index',['categories'=>$categories]);
    }

    public function store(CategoryStoreRequest $request)
    {
        //
        $category              = new Category;
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return back()->with('mensajecat','!! categoría agregada con exito!!');
    }

    public function update(Request $request)
    {
        //
        $category              =  Category::findOrFail($request->id);
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        return back()->with('mensajecat','!! categoría Actualizada con exito!!');
    }

    public function destroy(Request $request )
    {
        $category =  Category::findOrFail($request->id);
        $category->delete();
        return back()->with('mensajecat','!! categoría eliminada con exito!!');
    }
}
