<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'bank_name',
        'account_number',
        'account_owner',
        'nominal',
        'transfer_date',
        'image_path',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}

