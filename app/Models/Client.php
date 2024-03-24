<?php

namespace App\Models;

use App\Models\Rating;
use App\Models\Command;
use App\Models\PaymentInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    public function command(){
        return $this->hasMany(Command::class);
    }

    public function paymentInfo(){
        return $this->hasOne(PaymentInfo::class);
    }
}
