<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'link_name',
        'description',
        'price',
        'old_price',
        'count',
        'is_infinitely',
        'raiting',
        'user_id',
        'category_id',
        'vendor_id',
        'status',
        'date_publication',
    ];

    public function files(): MorphMany
    {
        return $this->morphMany(FileRelationship::class, 'file_relable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(ImageRelat::class, 'image_relatsable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }


    public function statistic_days(): MorphMany
    {
        return $this->morphMany(StatisticDay::class, 'stat_relatsable');
    }

    public function product_property_item(): HasMany
    {
        return $this->hasMany(ProductPropertyItem::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->limit(20);
    }

    public function chats(): MorphMany
    {
        return $this->morphMany(Chat::class, 'chatable');
    }
}
