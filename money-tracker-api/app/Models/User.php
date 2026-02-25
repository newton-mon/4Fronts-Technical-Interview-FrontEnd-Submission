class User extends Model
{
    protected $fillable = ['name', 'email'];
    protected $appends = ['total_balance'];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    // Accessor to calculate the overall balance across all wallets
    public function getTotalBalanceAttribute()
    {
        return $this->wallets->sum(function ($wallet) {
            return $wallet->balance; // Uses the accessor from the Wallet model
        });
    }
}