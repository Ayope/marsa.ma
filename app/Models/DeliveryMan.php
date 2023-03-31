<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    use HasFactory;

    public function vehicle(){
        return $this->hasOne('Vehicle');
    }

    public function command(){
        return $this->hasMany('Command');
    }

    public function candidature(){
        return $this->hasMany('Candidature');
    }

    public function fisher(){
        return $this->belongsTo('Fisher');
    }
}
