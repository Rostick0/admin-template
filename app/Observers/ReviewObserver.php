<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        $review->product()->update([
            'raiting' => $review->product->reviews()->average('mark')
        ]);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {


        if ($review->mark !== $review->getOriginal('mark')) {
            $review->product()->update([
                'raiting' => number_format($review->product->reviews()->average('mark'), 2)
            ]);

            $product = $review->product;
            $product->user()->update([
                'raiting' => number_format(Product::where('user_id', $product->user->id)
                    ->average('raiting'), 2),
            ]);
        }
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }
}
