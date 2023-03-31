<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function Rating(){
        return $this->hasMany('rating');
    }

    public function Fisher(){
        return $this->hasOne('fisher');
    }

    public function deliveryMan(){
        return $this->belongsTo('DeliveryMan');
    }

    public function command()
    {
        return $this->belongsToMany('Command','product_commands');
    }
}
