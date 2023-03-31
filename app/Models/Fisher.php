<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fisher extends Model
{
    use HasFactory;

    public function deliveryMan(){
        return $this->hasMany('DeliveryMan');
    }

    public function product(){
        return $this->hasMany('Product');
    }
}
