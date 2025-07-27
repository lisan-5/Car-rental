<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the carts for the user.
     */
    public function carts()
    {
        return $this->hasMany(\App\Models\Cart::class);
    }
    /**
     * Get the cars posted by the user.
     */
    public function cars()
    {
        return $this->hasMany(\App\Models\Car::class);
    }
    /**
     * Get all rental requests for the user's cars.
     */
    public function rentalRequests()
    {
        return $this->hasManyThrough(
            \App\Models\Rental::class,
            \App\Models\Car::class,
            'user_id', // Foreign key on cars table
            'car_id',  // Foreign key on rentals table
            'id',      // Local key on users table
            'id'       // Local key on cars table
        );
    }
}
