<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public $timestamps=false;

    // un rol tiene muchos usuarios
    public function users(){
        return $this->hasMany(User::class);
    }
}
