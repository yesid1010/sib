<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoryStoreRequest;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    //

    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        // $fecha = Carbon::now()->format('d-m-Y');
        // $fechaA = Carbon::now()->format('d-m-Y');
        return view('categories.index',['categories'=>$categories]);
    }

    public function store(CategoryStoreRequest $request)
    {
        //
        $category              = new Category;
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();

        alert()->success('OK', '!! categoría agregada con exito!!')->autoclose(3000);;
        return back();
    }

    public function update(Request $request)
    {
        //
        $category              =  Category::findOrFail($request->id);
        $category->name        = $request->input('name');
        $category->description = $request->input('description');
        $category->save();
        alert()->success('OK', '!! categoría actualizada con exito!!')->autoclose(3000);;
        return back();
    }

    public function destroy(Request $request )
    {
        $category =  Category::findOrFail($request->id);
        $category->delete();
        alert()->success('OK', '!! categoría eliminada con exito!!')->autoclose(3000);;
        return back();
    }
}
