<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'identity_type',
        'identity_number',
        'country',
        'nationality',
        'city',
        'township',
        'address',
        'contact_person',
        'contact_person_relationship',
        'contact_person_mobile_number',
    ];
}
