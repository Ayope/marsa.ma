<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentInfo extends Model
{
    use HasFactory;

    public function client(){
        return $this->hasOne(Client::class);
    }

    protected $fillable = [
        'client_id',
        'card_number',
        'security_code',
        'expiration_month',
        'expiration_year',
    ];

    protected $hidden = [
        'card_number',
        'security_code',
        'expiration_month',
        'expiration_year',
    ];
}
