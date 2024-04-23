<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_start_date',
        'reservation_start_time',
        'reservation_end_date',
        'reservation_end_time',
        'employee_id',
        'gender',
        'quantity',
        'occupant_type',
        'price',
        'is_senior_or_pwd',
        'is_child',

    ];
}
