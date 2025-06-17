<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Transfer, Account, Transaction};
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    /**
     * Registrar una transferencia entre cuentas y transacciones asociadas.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_id' => 'required|exists:accounts,id|different:from_account_id',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($fields) {
            $from = Account::lockForUpdate()->findOrFail($fields['from_account_id']);
            $to = Account::lockForUpdate()->findOrFail($fields['to_account_id']);

            if ($from->balance < $fields['amount']) {
                return response()->json(['message' => 'Fondos insuficientes'], 422);
            }

            $from->balance -= $fields['amount'];
            $from->save();

            $to->balance += $fields['amount'];
            $to->save();

            $transfer = Transfer::create([
                'from_account_id' => $from->id,
                'to_account_id' => $to->id,
                'amount' => $fields['amount'],
                'description' => $fields['description'] ?? null,
                'status' => 'completed',
                'transferred_at' => now(),
            ]);

            Transaction::create([
                'account_id' => $from->id,
                'source_account_id' => $to->id,
                'type' => 'transfer_out',
                'amount' => $fields['amount'],
                'description' => $fields['description'] ?? 'Transferencia enviada',
                'balance_after' => $from->balance,
                'order_id' => null,
                'recharge_id' => null,
            ]);

            Transaction::create([
                'account_id' => $to->id,
                'source_account_id' => $from->id,
                'type' => 'transfer_in',
                'amount' => $fields['amount'],
                'description' => $fields['description'] ?? 'Transferencia recibida',
                'balance_after' => $to->balance,
                'order_id' => null,
                'recharge_id' => null,
            ]);

            return response()->json(['transfer' => $transfer], 201);
        });
    }
}
