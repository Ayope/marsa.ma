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

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function product(){
        return $this->hasOneMany(Product::class, 'product_commands');
    }

    protected $fillable = [
        'delivery_man_id',
        'client_id',
        'status',
        'payment_method'
    ];

    protected $hidden = [
        'delivery_man_id',
        'client_id',
    ];
}
