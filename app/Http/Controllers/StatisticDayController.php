<?php

namespace App\Http\Controllers;

use App\Enum\StatisticType;
use App\Http\Requests\StatisticDay\IncrementStatisticDayRequest;
use App\Models\StatisticDay;
use App\Utils\EnumFields;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rostislav\LaravelFilters\Filter;
use Spatie\FlareClient\Api;

class StatisticDayController extends ApiController
{
    public function __construct()
    {
        $this->model = new StatisticDay;
    }

    protected static function getWhere(Request $request = null)
    {
        $where = [];

        if (auth()->user()?->role !== 'admin' || (auth()->user()?->role === 'admin' && !$request->for_admin)) {
            // $where[] = ['id', '=', auth()?->id(), 'product.user'];
            // $where[] = ['id', '=', auth()?->id(), 'post.user'];
            $where[] = ['id', '=', auth()?->id(), 'stat_relatsable'];
            // stat_relatsable
        }

        return $where;
    }

    public function index(Request $request)
    {
        // dd(StatisticDay::first()->stat_relatsable);

        $select = [
            'date',
            'stat_relatsable_type',
            ...array_map(function ($elem) {
                return DB::raw('SUM(CASE WHEN type = "' . $elem . '" THEN count ELSE 0 END) AS ' . $elem);
            }, EnumFields::getColumn(StatisticType::class)),
        ];
        $group_by_params = ['date', 'stat_relatsable_type'];


        if ($request->is_relat_group) {
            $select[] = 'stat_relatsable_id';
            $group_by_params[] = 'stat_relatsable_id';
        }

        $data =
            Filter::query($request, $this->model, [], $this::getWhere($request))
            ->select(
                $select
            )
            ->groupBy($group_by_params);

        // dd($data->toSql());
        return new JsonResponse(
            $data->paginate($request->limit ?? 7)
        );
    }


    public function increment(IncrementStatisticDayRequest $request)
    {
        $data = $request->model::find($request->id)
            ->statistic_days()
            ->updateOrCreate([
                'type' => $request->type,
                'date' => Carbon::now()->format('Y-m-d')
            ]);

        $data->increment('count');

        return new JsonResponse([
            'message' => 'sucсess',
        ]);
    }
}
