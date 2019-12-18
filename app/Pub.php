<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    public $timestamps=false;
    //
    // un bar puede estar en varias ordenes
    public function orders(){
        return $this->hasMany(Order::class);
    }

    // un bar puede tener un solo stock ideal
    public function stock(){
        return $this->hasOne(Stock::class);
    }
}
