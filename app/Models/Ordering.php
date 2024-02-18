<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    ];

    public function product_users(): HasMany
    {
        return $this->hasMany(ProductUser::class);
    }
}
