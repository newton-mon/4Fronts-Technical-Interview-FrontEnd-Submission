<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
