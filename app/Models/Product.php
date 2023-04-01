<?php

namespace App\Models;

use App\Models\Fisher;
use App\Models\Rating;
use App\Models\Command;
use App\Models\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function Rating(){
        return $this->hasMany(Rating::class);
    }

    public function Fisher(){
        return $this->hasOne(Fisher::class);
    }

    public function deliveryMan(){
        return $this->hasOne(DeliveryMan::class);
    }

    public function command(){
        return $this->hasOneMany(Command::class,'product_commands');
    }

    protected $fillable = [
        'title',
        'fish_type',
        'photo',
        'quantity',
        'price',
        'date_of_fishing',
        'description',
        'fisher_id',
    ];

    protected $hidden = [
        'fisher_id',
        'quantity'
    ];
}
