<?php

namespace App\Models;

use App\Models\Product;
use App\Models\JobOffer;
use App\Models\Candidature;
use App\Models\DeliveryMan;
use App\Models\FishingLiscence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fisher extends Model
{
    use HasFactory;

    public function deliveryMan(){
        return $this->hasMany(DeliveryMan::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function jobOffer()
    {
        return $this->hasMany(JobOffer::class);
    }

    public function candidature(){
        return $this->hasMany(Candidature::class);
    }

    public function fishingLiscence(){
        return $this->hasOne(FishingLiscence::class);
    }
}
