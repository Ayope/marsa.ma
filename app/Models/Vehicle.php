<?php

namespace App\Models;

use App\Models\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    public function DeliveryMan(){
        return $this->hasOne(DeliveryMan::class, 'vehicle_id');
    }

    protected $fillable = [
        'registration_matricule',
        'make',
        'model',
        'capacity',
        'photo',
        'type',
        'insurance',
        'delivery_man_id'
    ];

    protected $hidden = [
        'registration_matricule',
        'delivery_man_id'
    ];

}
