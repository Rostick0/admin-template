<?php

namespace App\Http\Controllers;

use App\Enum\OrderingStatusType;
use App\Enum\StatusType;
use App\Http\Requests\UserStatisticController\OrderingsUserStatisticController;
use App\Models\Ordering;
use App\Models\OrderingProduct;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rostislav\LaravelFilters\Filter;

class UserStatisticController extends Controller
{

    public function index(Request $request)
    {
        $user_id = ['user_id', '=', auth()->id()];

        $data = [
            'total_sum' => Filter::query($request, new Ordering, [], [$user_id])->sum('price'),
            'comments_sum' => Filter::query($request, new Review, [], [$user_id])->count(),
            'buy_count' => Filter::query($request, new OrderingProduct, [], [[...$user_id, 'ordering']])
                ->distinct('product_id')
                ->count(),
            'doesnt_have_review' => Filter::query($request, new OrderingProduct, [], [[...$user_id, 'ordering'],])
                ->doesntHave('product.my_review')
                ->distinct('product_id')
                ->count()
        ];

        return new JsonResponse([
            'data' => $data
        ]);
    }

    public function orderings(OrderingsUserStatisticController $request)
    {


        $user_id = ['user_id', '=', auth()->id()];
        // ['status', '=', OrderingStatusType::completed->value]
        $date = ['date', '>=', Carbon::now()->subYear()->format('Y-m-d')];

        $period_sql = ($request->period ?? 'DATE') . '(created_at)';

        // dd(Carbon::now()->subYear());
        $data = Filter::query([], new Ordering, [], [$user_id, $date])
            ->select(DB::raw($period_sql . ' as date, SUM(price) as sum_total, COUNT(*) as sum_orderings'))
            // ->groupBy('date')
            ->groupBy(DB::raw($period_sql))
            ->orderBy('date')
            ->limit(366)
            // ->toSql()
            ->get()
        ;

        return new JsonResponse([
            'data' => $data
        ]);
    }
}
