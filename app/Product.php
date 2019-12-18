<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    // un producto pertenece a una sola categoría
    public function category(){
        return $this->belongsTo(Category::class);
    }


    // un producto puede estar en varias ordenes
    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    // un producto puede estar en varios stock ideales
    public function stocks(){
        return $this->belongsToMany(Stock::class);
    }
}
