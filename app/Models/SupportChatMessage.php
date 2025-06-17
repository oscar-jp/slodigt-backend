<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'sender_id',
        'message',
    ];

    public function chat()
    {
        return $this->belongsTo(SupportChat::class, 'chat_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
