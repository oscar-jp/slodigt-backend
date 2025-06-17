<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Recharge, Account, Transaction};

class RechargeController extends Controller
{
    /**
     * Registrar una recarga y registrar la transacción asociada.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0.01',
            'bank_name' => 'nullable|string|max:100',
            'reference' => 'nullable|string|max:100',
            'receipt_url' => 'nullable|string|max:255',
            'method' => 'in:bank,agent,card',
            'transaction_fee' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $recharge = Recharge::create($fields);

        $account = Account::findOrFail($fields['account_id']);
        $account->balance += $recharge->amount;
        $account->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'recharge',
            'amount' => $recharge->amount,
            'description' => 'Recarga de saldo',
            'balance_after' => $account->balance,
            'recharge_id' => $recharge->id,
        ]);

        return response()->json(['recharge' => $recharge], 201);
    }
}
