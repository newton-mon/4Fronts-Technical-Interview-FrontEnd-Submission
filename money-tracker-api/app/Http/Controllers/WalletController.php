public function store(Request $request)
{
    $data = $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required|string|max:255',
        'currency' => 'required|string|size:3'
    ]);

    return Wallet::create($data);
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
            'balance' => $income - $expense
        ],
        'transactions' => $wallet->transactions
    ]);
}