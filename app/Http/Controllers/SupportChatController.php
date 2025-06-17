<?php

namespace App\Http\Controllers;

use App\Events\SupportChatMessageSent;
use App\Models\SupportChat;
use App\Models\SupportChatMessage;
use Illuminate\Http\Request;

class SupportChatController extends Controller
{
    /**
     * Crear un chat de soporte asociado a un pedido o recarga.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'recharge_id' => 'nullable|exists:recharges,id',
        ]);

        $chat = SupportChat::create([
            'user_id' => $request->user()->id,
            'order_id' => $fields['order_id'] ?? null,
            'recharge_id' => $fields['recharge_id'] ?? null,
            'status' => 'open',
        ]);

        return response()->json(['chat' => $chat], 201);
    }

    /**
     * Enviar mensaje dentro de un chat de soporte.
     */
    public function sendMessage(Request $request, SupportChat $chat)
    {
        $fields = $request->validate([
            'message' => 'required|string',
        ]);

        $message = SupportChatMessage::create([
            'chat_id' => $chat->id,
            'sender_id' => $request->user()->id,
            'message' => $fields['message'],
        ]);

        broadcast(new SupportChatMessageSent($message))->toOthers();

        return response()->json(['message' => $message], 201);
    }
}
