<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function command(){
        return $this->hasMany('Command');
    }

    public function rating(){
        return $this->hasMany('Rating');
    }
}
