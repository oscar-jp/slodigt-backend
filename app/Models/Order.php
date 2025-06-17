<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Atributos asignables de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'business_id',
        'total_items',
        'total_amount',
        'status',
        'payment_method',
        'order_type',
        'delivery_address',
        'notes',
        'delivery_method',
        'address',
        'latitude',
        'longitude',
        'assigned_delivery_id',
        'delivered_at',
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
            'delivered_at' => 'datetime',
            'canceled_at'  => 'datetime',
        ];
    }

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function business()
    {
        return $this->belongsTo(User::class, 'business_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'assigned_delivery_id');
    }
}
