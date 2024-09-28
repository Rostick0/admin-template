<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class StatisticDay extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'count',
        'type',
        'date'
    ];

    public function stat_relatsable(): MorphTo
    {
        return $this->morphTo();
    }
}
