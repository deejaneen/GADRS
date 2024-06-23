<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $table = 'gym-reservations';

    protected $fillable = [
        'reservation_date',
        'reservation_time_start',
        'reservation_time_end',
        'occupant_type',
        'employee_id',
        'purpose',
        'form_group_number',
        'representative',
        'company_name',
        'contact_number',
        'office_address',
        'reservation_number',
        'status',
        'or_number',
        'or_date',
        'number_of_courts',
        'total_price',
    ];
}
