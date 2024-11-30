<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductProperty\StoreProductPropertyRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Json;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Rostislav\LaravelFilters\Filters\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Rostislav\LaravelFilters\Filter;
use Rostislav\LaravelFilters\Filters\FilterHasRequestUtil;
use Rostislav\LaravelFilters\Filters\FilterHasUtil;
use Rostislav\LaravelFilters\Filters\FilterRequestUtil;
use Rostislav\LaravelFilters\Filters\FilterSomeRequestUtil;
use Rostislav\LaravelFilters\Filters\OrderByUtil;
use Rostislav\LaravelFilters\Filters\QueryWith;

class ProductController extends ApiController
{
    public function __construct()
    {
        $this->model = new Product;
        $this->is_auth_id = true;
        $this->store_request = new StoreProductRequest;
        $this->update_request = new UpdateProductRequest;
        $this->q_request = [
            ['title', 'LIKE'],
            ['name', 'LIKE', 'category'],
            ['name', 'LIKE', 'vendor'],
        ];
    }

    protected static function extendsMutation($data, $request)
    {
        if ($request->has('images')) {
            $data->images()->delete();
            $images = array_map(function ($image_id) {
                return ['image_id' => $image_id];
            }, QueryString::convertToArray($request->images));

            $data->images()->createMany($images);
        }

        if ($request->has('files')) {
            $data->files()->delete();
            $files = array_map(function ($file_id) {
                return ['file_id' => $file_id];
            }, QueryString::convertToArray($request->input('files')));

            $data->files()->createMany($files);
        }

        if ($request->has('product_properties')) {
            $data->product_properties()->delete();
            $product_properties = [];

            foreach (Json::decode($request->product_properties) as $item) {
                $valid = Validator::make($item, (new StoreProductPropertyRequest)->rules($item));

                if (!$valid->passes()) continue;

                $product_properties[] = $valid->validated();
            }

            $data->product_properties()->createMany($product_properties);
        }
    }

    protected static function getWhere(?Request $request = null)
    {
        $where = [];

        if ($request->user()?->role !== 'admin') {
            // $where[] = ['is_show', '=', 1];
        }

        return $where;
    }

    public function index(Request $request)
    {
        $data = $this->model->search($request->search);

        if (isset($request['extends'])) {
            $data = $data->query(fn($query) => $query->with(QueryString::convertToArray($request['extends'])));
        }

        if (isset($request['doesntHave'])) {
            foreach (QueryString::convertToArray($request['doesntHave']) as $doesntHaveitem) {
                $data = $data->query(fn($query) => $query->doesntHave($doesntHaveitem));
            }
        }

        // $data = FilterRequestUtil::all($request, $data, $this->fillable_block);
        // $data = FilterHasRequestUtil::all($request, $data, $this->fillable_block);
        // $data = FilterHasUtil::all($request, $data, $this->fillable_block);
        // $data = FilterSomeRequestUtil::all($request, $data, $this->fillable_block);
        if (isset($request['sort'])) $data = OrderByUtil::set($request['sort'], $data);
        // if (isset($request['extendsCount'])) {
        //     // $data = $data?->withCount(QueryString::convertToArray($request['extendsCount']));
        //     $data = QueryWith::setSum($request, $data);
        // }

        // if (self::getWhere($request)) $data = Filter::where($data, $where);

        // return $data;

        return new JsonResponse($data->paginate($request->limit ?? 20));
    }
}
