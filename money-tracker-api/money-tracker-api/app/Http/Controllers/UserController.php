public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|unique:users,email'
    ]);

    return User::create($data);
}