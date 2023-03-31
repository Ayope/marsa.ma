<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;

    public function deliveryMan(){
        return $this->belongsTo('DeliveryMan');
    }

    public function client(){
        return $this->belongsTo('Client');
    }

    public function product()
    {
        return $this->belongsToMany('Product','product_commands');
    }
}
