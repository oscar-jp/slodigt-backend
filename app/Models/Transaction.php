<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'source_account_id',
        'type',
        'amount',
        'description',
        'balance_after',
        'recharge_id',
        'order_id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function sourceAccount()
    {
        return $this->belongsTo(Account::class, 'source_account_id');
    }

    public function recharge()
    {
        return $this->belongsTo(Recharge::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
