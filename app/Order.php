<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    // en una orden puede haber un solo usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    // en una orden puede haber un solo bar
    public function pub(){
        return $this->belongTo(Pub::class);
    }

    // en una orden pueden haber muchos productos
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
