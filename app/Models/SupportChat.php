<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'agent_id',
        'order_id',
        'recharge_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function recharge()
    {
        return $this->belongsTo(Recharge::class);
    }

    public function messages()
    {
        return $this->hasMany(SupportChatMessage::class, 'chat_id');
    }
}
