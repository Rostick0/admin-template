<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_name',
        'is_show'
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(ImageRelat::class, 'image_relatsable');
    }
}
