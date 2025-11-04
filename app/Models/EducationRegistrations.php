<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationRegistrations extends Model
{
    protected $fillable = [
        'event_name',
        'order_id',
        'full_name',
        'email',
        'gender',
        'contact_country_code',
        'contact_number',
        'address_line',
        'city',
        'state',
        'country',
        'zipcode',
        'company_name',
        'designation',
        'industry',
        'message',
    ];
}
