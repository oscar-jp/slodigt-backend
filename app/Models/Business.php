<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'logo_url',
        'address1',
        'address2',
        'city_id',
        'region_id',
        'country_id',
        'latitude',
        'longitude',
        'contact_email',
        'contact_phone',
        'website_url',
        'is_approved',
        'approved_at',
        'approved_by',
        'rating',
        'rating_count',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
            'approved_at' => 'datetime',
            'latitude' => 'decimal:6',
            'longitude' => 'decimal:6',
            'rating' => 'decimal:2',
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function roles()
    {
        return $this->hasMany(BusinessUserRole::class);
    }

    public function reviews()
    {
        return $this->hasMany(BusinessReview::class);
    }
}
