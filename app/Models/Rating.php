<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function product(){
        return $this->hasOne(Product::class);
    }

    protected $fillable = [
        'client_id',
        'ratings',
        'review',
        'product_id',
    ];

    protected $hidden = [
        'client_id',
        'product_id',
    ];
}
