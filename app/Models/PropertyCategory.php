<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_item_id',
        'category_id'
    ];

    public function property_item(): BelongsTo
    {
        return $this->belongsTo(PropertyItem::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
