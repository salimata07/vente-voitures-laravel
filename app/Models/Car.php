<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'year',
        'price',
        'mileage',
        'fuel_type',
        'transmission',
        'description',
        'status',
    ];

    // Relation : une voiture appartient à un utilisateur (vendeur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(CarImage::class);
    }
}
