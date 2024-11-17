<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link_name',
        'description',
        'parent_id',
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->limit(20);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(ImageRelat::class, 'image_relatsable');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->limit(20);
    }

    public function property_categories(): BelongsTo
    {
        return $this->belongsTo(PropertyCategory::class);
    }
}
