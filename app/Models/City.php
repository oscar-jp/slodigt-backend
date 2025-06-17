<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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
        'region_id',
        'name',
    ];

    /**
     * Get the region that owns the city.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Access the country through the region.
     */
    public function country()
    {
        return $this->hasOneThrough(Country::class, Region::class);
    }

    /**
     * Get the businesses located in the city.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
