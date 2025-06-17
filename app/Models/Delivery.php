<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'courier_id',
        'status',
        'delivered_at',
        'picked_up_at',
        'pickup_code',
        'pickup_verified_at',
        'delivery_code',
        'delivery_verified_at',
        'last_track_id',
        'canceled_at',
    ];

    /**
     * Conversión de atributos a tipos nativos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'delivered_at'        => 'datetime',
            'picked_up_at'        => 'datetime',
            'pickup_verified_at'  => 'datetime',
            'delivery_verified_at'=> 'datetime',
            'canceled_at'         => 'datetime',
        ];
    }

    // Relaciones
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }

    public function lastTrack()
    {
        return $this->belongsTo(DeliveryTrack::class, 'last_track_id');
    }

    public function tracks()
    {
        return $this->hasMany(DeliveryTrack::class);
    }
}
