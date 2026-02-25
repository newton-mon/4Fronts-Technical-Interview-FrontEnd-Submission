// 1.Create a user.

Route::post('/users', [UserController::class, 'store']);

// 2.Retrieve a user's profile, including their wallets and transactions.
Route::get('/users/{id}/profile', [ProfileController::class, 'show']);

//3. select a wallet and view its details, including the current balance and transaction history.
Route::post('/wallets', [WalletController::class, 'store']);

//4. View the details of a specific wallet, including its current balance and transaction history.
Route::get('/wallets/{id}', [WalletController::class, 'show']);

//5. Add a new transaction to a wallet.
Route::post('/transactions', [TransactionController::class, 'store']);
