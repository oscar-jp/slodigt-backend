<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTrack extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'latitude',
        'longitude',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
