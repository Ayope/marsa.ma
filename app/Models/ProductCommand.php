<?php

namespace App\Models;

use App\Models\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCommand extends Model
{
    use HasFactory;

    protected $fillable = [
        'command_id',
        'product_id',
        'quantity',
    ];

    protected $hidden = [
        'command_id',
        'product_id',
    ];

    public function command(){
        return $this->belongsTo(Command::class);
    }
}
