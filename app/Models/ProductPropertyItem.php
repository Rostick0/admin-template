<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPropertyItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'property_item_id',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function property_item(): BelongsTo
    {
        return $this->belongsTo(PropertyItem::class);
    }
}
