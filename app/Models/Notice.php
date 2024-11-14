<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'text',
        'type',
        'is_read',
        'user_id',
        'date_publication',
    ];

    public function notice_relat(): BelongsTo
    {
        return $this->belongsTo(NoticeRelat::class);
    }
}
