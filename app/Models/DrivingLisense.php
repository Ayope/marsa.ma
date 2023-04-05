<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrivingLisense extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_number',
        'issue_date',
        'expiration_date',
        'issuing_place',
        'class',
        'document',
        'notes',
        'delivery_man_id'
    ];

    protected $dates = [
        'issue_date',
        'expiration_date',
    ];

    public function deliveryMan()
    {
        return $this->hasOne(DeliveryMan::class);
    }
}
