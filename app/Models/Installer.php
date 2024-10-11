<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installer extends Model
{
    use HasFactory;
    // Define which attributes can be mass assigned
    protected $fillable = [
        'business_name',
        'email',
        'phone_number',
        'website_url',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'status',
        'url',  // Auto-generate URL from business name
    ];
}
