<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDatePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'value',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
