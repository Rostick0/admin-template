<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PropertyItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_top',
        'type',
        'value',
        'unit',
        'property_id',
        'property_type_id'
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }


    public function property_type(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }
    public function property_categories(): HasMany
    {
        return $this->hasMany(PropertyCategory::class);
    }
}
