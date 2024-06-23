<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Dorm extends Model
{
    use HasFactory;

    protected $table = 'dorm_reservations';
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
        'form_group_number',
        'first_name',
        'middle_name',
        'last_name',
        'office',
        'office_address',
        'position',
        'contact_number',
        'email',
        'employee_number',
        'id_presented',
        'purpose_of_stay',
        'coa_referrer',
        'relationship_with_guest',
        'coa_referrer_office',
        'coa_referrer_office_address',
        'emergency_contact',
        'emergency_contact_number',
        'home_address',
        'Form_number',
        'status',
        'total_price',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::updated(function ($dorm) {
    //         Log::info('Dorm model: updated event fired for Dorm ID ' . $dorm->id);
    //     });
    // }
}
