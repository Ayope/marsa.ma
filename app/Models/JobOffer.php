<?php

namespace App\Models;

use App\Models\Fisher;
use App\Models\Candidature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOffer extends Model
{
    use HasFactory;

    public function fisher(){
        return $this->hasOne(Fisher::class);
    }

    public function candidature(){
        return $this->hasMany(Candidature::class);
    }

    protected $fillable = [
        'description',
        'number_of_places',
        'deliveries_per_day',
        'salary',
        'vehicle_required',
        'status',
        'fisher_id',
    ];

    protected $hidden = [
        'fisher_id',
    ];
}
