<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderingProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'product_id',
        'ordering_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function ordering(): BelongsTo
    {
        return $this->belongsTo(Ordering::class);
    }
}
