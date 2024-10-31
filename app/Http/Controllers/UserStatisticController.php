<?php

namespace App\Http\Controllers;

use App\Models\Ordering;
use App\Models\OrderingProduct;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filter;

class UserStatisticController extends Controller
{

    public function index(Request $request)
    {
        $user_id = ['user_id', '=', auth()->id()];

        $data = [
            'total_sum' => Filter::query($request, new Ordering, [], [$user_id])->sum('price'),
            'comments_sum' => Filter::query($request, new Review, [], [$user_id])->count(),
            'buy_count' => Filter::query($request, new OrderingProduct, [], [[...$user_id, 'ordering']])->count(),
            // 'a' => Filter::query($request, new Ordering, [], [$user_id])->ordering_product,
        ];

        return new JsonResponse([
            'data' => $data
        ]);
    }
}
