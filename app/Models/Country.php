<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
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
        'name',
    ];

    /**
     * Get the regions for the country.
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    /**
     * Get the businesses located in the country.
     */
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
