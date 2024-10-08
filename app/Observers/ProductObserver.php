<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductDatePrice;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $product->date_prices()->create([
            'value' => $product->price
        ]);
    }

    /**ƒ
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->price != $product->getOriginal()['price']) {
            $product->date_prices()->create([
                'value' => $product->price
            ]);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
