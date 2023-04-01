<?php

namespace App\Models;

use App\Models\Fisher;
use App\Models\JobOffer;
use App\Models\DeliveryMan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidature extends Model
{
    use HasFactory;

    public function deliveryMan(){
        return $this->hasOne(DeliveryMan::class);
    }

    public function fisher(){
        return $this->hasOne(Fisher::class);
    }

    public function jobOffer(){
        return $this->hasOne(JobOffer::class);
    }

    protected $fillable = [
        'job_offer_id',
        'fisher_id',
        'candidate_id',
        'status',
    ];

    protected $hidden = [
        'job_offer_id',
        'fisher_id',
        'candidate_id',
    ];
}
