<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    protected $appends = ['main_image'];

    public function files(): MorphMany
    {
        return $this->morphMany(FileRelationship::class, 'file_relable');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(ImageRelat::class, 'image_relatsable');
    }

    public function getMainImageAttribute()
    {
        return $this->images()->with('image')->first();
    }

    public function my_review(): HasOne
    {
        return $this->hasOne(Review::class)
            ->where(
                'user_id',
                auth()->id()
            )
            ->latest('id');
    }

    public function my_buy(): HasOne
    {
        return $this->hasOne(OrderingProduct::class)
            ->whereHas(
                'ordering',
                fn($query) => $query->where('user_id', auth()->id())
            );
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

    public function product_properties(): HasMany
    {
        return $this->hasMany(ProductProperty::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->limit(20);
    }

    public function chats(): MorphMany
    {
        return $this->morphMany(Chat::class, 'chatable');
    }

    public function date_prices(): HasMany
    {
        return $this->hasMany(ProductDatePrice::class);
    }
}
