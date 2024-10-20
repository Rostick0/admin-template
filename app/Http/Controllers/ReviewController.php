<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Models\Review;
use App\Utils\AccessUtil;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filters\QueryString;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->model = new Review;
        $this->store_request = new StoreReviewRequest;
        $this->update_request = new UpdateReviewRequest;
        $this->is_auth_id = true;
    }

    protected static function extendsMutation($data, $request)
    {
        if ($request->has('images')) {
            $data->images()->delete();
            $images = array_map(
                fn($image_id) => ['image_id' => $image_id],
                QueryString::convertToArray($request->images)
            );

            $data->images()->createMany($images);
        }
    }

    public function store(Request $request)
    {
        // dd($request->user()->reviews()->where('product_id', $request->product_id)->count());
        if ($request->user()->reviews()->where('product_id', $request->product_id)->count()) return AccessUtil::errorMessage('Review already exists', 400);

        return parent::store($request);
    }

    public function showByProductId(Request $request, int $id)
    {
        return $request->user()->reviews()
            ->where('product_id', $id)
            ->with(QueryString::convertToArray($request->extends))
            ->firstOrFail();
    }
}
