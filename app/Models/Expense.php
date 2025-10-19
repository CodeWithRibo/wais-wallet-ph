<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'category',
        'date',
        'payment_method',
        'notes',
        'wallet_type',
        'user_id',
        'wallet_id',
        'category_id',
    ];

    public function scopeSearch(Builder $query, $term)
    {
        $query
            ->where(function ($q) use ($term) {
                $q->whereLike('category', '%'.$term.'%' ?? '')
                    ->orWhereLike('notes', '%'.$term.'%' ?? '')
                    ->orWhereLike('amount', '%'.$term.'%' ?? '');
            });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }

    public function categoryRelation() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
}
