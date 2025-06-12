<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'user_id', 
        'visit_date', 
        'adult_ticket_count',
        'child_ticket_count', 
        'promo_code', 
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Definisikan relasi hasOne ke PaymentConfirmation
    public function paymentConfirmation()
    {
        return $this->hasOne(PaymentConfirmation::class);
    }

        public function toPublicArray()
    {
        return [
            'ticket_number'       => $this->ticket_number,
            'user_id'             => $this->user_id,
            'visit_date'          => $this->visit_date,
            'adult_ticket_count'  => $this->adult_ticket_count,
            'child_ticket_count'  => $this->child_ticket_count,
            'promo_code'          => $this->promo_code,
            'total_price'         => $this->total_price,
            'status'              => $this->status,
        ];
    }

}
