<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //

    // un stock pertenece a un solo bar
    public function pub(){
        return $this->hasOne(Pub::class);
    }

    // en un stock ideal pueden haber muchos productos
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
