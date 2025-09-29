<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_name',
        'current_balance',
        'wallet_type',
        'user_id',
    ];

    public function Expense(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
