<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPropertyItem\StoreProductPropertyItemRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Json;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Rostislav\LaravelFilters\Filters\QueryString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends ApiController
{
    public function __construct()
    {
        $this->model = new Product;
        $this->is_auth_id = true;
        $this->store_request = new StoreProductRequest;
        $this->update_request = new UpdateProductRequest;
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

        if ($request->has('product_property_item')) {
            $data->product_property_item()->delete();
            $product_property_items = [];

            foreach (Json::decode($request->product_property_item) as $item) {
                $valid = Validator::make($item, (new StoreProductPropertyItemRequest)->rules());

                if (!$valid->passes()) continue;

                $product_property_items[] = $valid->validated();
            }

            $data->product_property_items()->createMany($product_property_items);
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
}
