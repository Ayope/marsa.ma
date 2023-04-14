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

    public function rating(){
        return $this->hasMany(Rating::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'fisher_id');
    }

    public function deliveryMan(){
        return $this->hasOne(DeliveryMan::class);
    }

    public function command(){
        return $this->belongsToMany(Command::class,'product_commands');
    }

    protected $fillable = [
        'title',
        'fish_type',
        'photo',
        'quantity',
        'price',
        'date_of_fishing',
        'description',
        'status',
        'fisher_id',
    ];

    protected $hidden = [
        'fisher_id',
    ];
}
