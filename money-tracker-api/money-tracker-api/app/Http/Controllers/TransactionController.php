public function store(Request $request)
{
    $data = $request->validate([
        'wallet_id' => 'required|exists:wallets,id',
        'type' => 'required|in:income,expense',
        'amount' => 'required|numeric|min:0.01',
        'description' => 'nullable|string|max:255'
    ]);

    return Transaction::create($data);
}