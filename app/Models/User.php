<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\DeliveryMan;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'address',
        'photo'
    ];

    protected $hidden = [
        'password',
    ];

    public function deliveryMan()
    {
        return $this->hasOne(DeliveryMan::class , 'delivery_man_id');
    }

    public function product(){

        return $this->hasMany(Product::class, 'fisher_id');
    }

    public function command(){
        return $this->hasMany(Command::class, 'client_id');
    }
}
