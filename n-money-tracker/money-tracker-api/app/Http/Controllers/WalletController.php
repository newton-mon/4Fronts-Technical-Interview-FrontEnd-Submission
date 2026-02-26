<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet; 
use App\Http\Controllers\Controller;

class WalletController extends Controller 
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'currency' => 'required|string|size:3'
        ]);

        $wallet = Wallet::create($data);

        return response()->json($wallet, 201);
    }

    public function show($id)
    {
        $wallet = Wallet::with('transactions')->findOrFail($id);

        $income = $wallet->transactions->where('type', 'income')->sum('amount');
        $expense = $wallet->transactions->where('type', 'expense')->sum('amount');

        return response()->json([
            'wallet' => [
                'id' => $wallet->id,
                'name' => $wallet->name,
                'currency' => $wallet->currency,
                'balance' => $income - $expense
            ],
            'transactions' => $wallet->transactions
        ]);
    }

    public function index()
    {
    return Wallet::all();
    }
}