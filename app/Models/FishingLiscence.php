<?php

namespace App\Models;

use App\Models\Fisher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FishingLiscence extends Model
{
    use HasFactory;

    public function fisher(){
        return $this->hasOne(Fisher::class);
    }

    protected $fillable = [
        'license_number',
        'expiration_date',
        'issue_date',
        'type',
        'issuing_authority',
        'fisher_id',
        'document',
        'notes',
    ];

    protected $hidden = [
        'license_number',
        'fisher_id'
    ];

}
