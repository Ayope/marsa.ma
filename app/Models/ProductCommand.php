<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCommand extends Model
{
    use HasFactory;

    protected $fillable = [
        'command_id',
        'product_id',
        'quantity'
    ];

    protected $hidden = [
        'command_id',
        'product_id',
    ];
}
