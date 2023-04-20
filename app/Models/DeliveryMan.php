<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fisher;
use App\Models\Command;
use App\Models\Vehicle;
use App\Models\Candidature;
use App\Models\DrivingLisense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryMan extends Model
{
    use HasFactory;

    public function vehicle(){
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function command(){
        return $this->hasMany(Command::class);
    }

    public function candidature(){
        return $this->hasMany(Candidature::class);
    }

    public function fisher(){
        return $this->hasOne(Fisher::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'delivery_man_id');
    }

    public function drivingLisense()
    {
        return $this->belongsTo(DrivingLisense::class, 'driving_lisence_id');
    }


    protected $fillable = [
        'max_deliveries_in_day',
        'delivery_man_id',
        'fisher_id',
        'vehicle_id',
        'driving_lisence_id',
    ];

    protected $hidden = [
        'delivery_man_id',
        'fisher_id',
        'vehicle_id',
        'driving_lisence_id',
    ];

}
