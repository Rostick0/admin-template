<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ordering extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'address',
        'status',
        'reason',
        'user_id',
    ];

    public function product_users(): HasMany
    {
        return $this->hasMany(ProductUser::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
