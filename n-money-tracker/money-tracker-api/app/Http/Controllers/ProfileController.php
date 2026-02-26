<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show($id)
    {
        $user = User::with('wallets.transactions')->findOrFail($id);

        $wallets = [];
        $totalBalance = 0;

        foreach ($user->wallets as $wallet) {
            $income = $wallet->transactions->where('type', 'income')->sum('amount');
            $expense = $wallet->transactions->where('type', 'expense')->sum('amount');
            $balance = $income - $expense;

            $totalBalance += $balance;

            $wallets[] = [
                'id' => $wallet->id,
                'name' => $wallet->name,
                'balance' => $balance
            ];
        }

        return response()->json([
            'user' => $user,
            'wallets' => $wallets,
            'total_balance' => $totalBalance
        ]);
    }
}