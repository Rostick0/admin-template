<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class NoticeRelat extends Model
{
    use HasFactory;

    public function notice_relseable(): MorphTo
    {
        return $this->morphTo();
    }
}
