<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDeliveryLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'courier_id',
        'is_favorite',
        'is_blocked',
    ];

    protected function casts(): array
    {
        return [
            'is_favorite' => 'boolean',
            'is_blocked' => 'boolean',
        ];
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function courier()
    {
        return $this->belongsTo(User::class, 'courier_id');
    }
}
