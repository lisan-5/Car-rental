<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    /**
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'price_per_day',
        'price_per_week',
        'price_per_month',
        'seats',
        'description',
        'image_path',
        'user_id',
        'is_rented',
    ];

    /**
     * Get the owner of the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
