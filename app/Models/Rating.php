<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
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
