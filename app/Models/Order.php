<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'car_id',
        'buyer_id',
        'invoice_number',
        'amount',
        'payment_status',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
