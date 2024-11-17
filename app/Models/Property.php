<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'unit',
        'property_type_id',
        'is_top',
        'is_filter',
    ];

    public function property_type(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function property_values(): HasMany
    {
        return $this->hasMany(PropertyValue::class);
    }

    public function property_categories(): HasMany
    {
        return $this->hasMany(PropertyCategory::class);
    }
}
