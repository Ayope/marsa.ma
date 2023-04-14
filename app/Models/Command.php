<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Product;
use App\Models\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Command extends Model
{
    use HasFactory;

    public function deliveryMan(){
        return $this->hasOne(DeliveryMan::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class, 'product_commands');
    }



    protected $fillable = [
        'delivery_man_id',
        'client_id',
        'status',
        'payment_method',
    ];

    protected $hidden = [
        'delivery_man_id',
        'client_id',
    ];
}
