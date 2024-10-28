<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'link_name',
        'description',
        'content',
        'user_id',
        'rubric_id',
        'source',
        'count_view',
        'status',
        'is_private',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rubric(): BelongsTo
    {
        return $this->belongsTo(Rubric::class);
    }

    public function statistic_days(): MorphMany
    {
        return $this->morphMany(StatisticDay::class, 'stat_relatsable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'comment_relatsable')->limit(20);
    }
}
