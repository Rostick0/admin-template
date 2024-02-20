<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPropertyItem\StoreProductPropertyItemRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Casts\Json;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Utils\QueryString;
use Illuminate\Http\Request;
use Validator;

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
        $data->images()->delete();
        if ($request->has('images')) {
            $images = array_map(function ($image_id) {
                return ['image_id' => $image_id];
            }, QueryString::convertToArray($request->images));

            $data->images()->createMany($images);
        }

        $data->files()->delete();
        if ($request->has('files')) {
            $files = array_map(function ($file_id) {
                return ['file_id' => $file_id];
            }, QueryString::convertToArray($request->files));

            $data->files()->createMany($files);
        }

        $data->product_property_item()->delete();
        if ($request->has('product_property_item')) {
            $product_property_items = [];

            foreach (Json::decode($request->product_property_item) as $item) {
                $valid = Validator::make($item, (new StoreProductPropertyItemRequest)->rules());

                if (!$valid->passes()) continue;

                $product_property_items[] = $valid->validated();
            }  

            $data->product_property_items()->createMany($product_property_items);
        }
    }
}
