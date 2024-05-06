<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateRestriction extends Model
{
    use HasFactory;
    protected $table = 'date_restrictions';

    protected $fillable = [
        'restricted_date',
        'description',
        'type',
    ];
}
