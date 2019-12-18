<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps=false;
    // una categoria tiene muchos productos
    public function products(){
        return $this->hasMany(Product::class);
    }
}
