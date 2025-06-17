<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'fullname',
        'lastname',
        'email',
        'password',
        'phone',
        'role',
        'address1',
        'address2',
        'city_id',
        'region_id',
        'country_id',
        'latitude',
        'longitude',
        'photo_url',
        'identity_verified',
        'delivery_level',
        'rating',
        'active_status',
        'daily_hours_limit',
        'tips_balance',
        'balance',
        'terms_accepted_at',
        'privacy_accepted_at',
        'age_verified',
        'consent_data_usage',
        'consent_marketing',
    ];

    /**
     * Atributos que deben ocultarse en respuestas JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión de atributos a tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'terms_accepted_at' => 'datetime',
            'privacy_accepted_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Businesses that this user owns.
     */
    public function ownedBusinesses()
    {
        return $this->hasMany(Business::class);
    }

    /**
     * Roles the user holds within businesses.
     */
    public function businessRoles()
    {
        return $this->hasMany(BusinessUserRole::class);
    }

    /**
     * Reviews the user has written for businesses.
     */
    public function businessReviews()
    {
        return $this->hasMany(BusinessReview::class);
    }
}
