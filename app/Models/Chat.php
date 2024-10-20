<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Chat extends Model
{
    use HasFactory;

    public function chatable(): MorphTo
    {
        return $this->morphTo();
    }

    public function chat_users(): HasMany
    {
        return $this->hasMany(ChatUser::class);
    }

    public function message_last(): HasMany
    {
        return $this->hasMany(Message::class)->latest('id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->limit(20);
    }
}
