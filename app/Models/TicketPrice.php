<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'adult_price_weekday',
        'child_price_weekday',
        'adult_price_weekend',
        'child_price_weekend',
    ];
}
