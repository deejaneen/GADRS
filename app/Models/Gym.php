<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_date',
        'reservation_time_start',
        'reservation_time_end',
        'occupant_type',
    ];

}