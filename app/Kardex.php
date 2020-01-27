<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    //

        // en un kardex pueden haber muchos productos
        public function products(){
            return $this->belongsToMany(Product::class);
        }
}
