<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Models\Review;
use App\Utils\AccessUtil;
use Illuminate\Http\Request;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->model = new Review;
        $this->store_request = new StoreReviewRequest;
        $this->update_request = new UpdateReviewRequest;
        $this->is_auth_id = true;
    }

    public function store(Request $request)
    {
        if ($request->user()->reviews()->where('product_id', $request->product_id)->get()) return AccessUtil::errorMessage('Review already exists', 400);

        return parent::store($request);
    }
}
