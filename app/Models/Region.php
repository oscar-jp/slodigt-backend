<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country_id',
        'name',
    ];

    /**
     * Get the country that owns the region.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the cities for the region.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Get the businesses located in the region.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
