<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Rostislav\LaravelFilters\Filters\QueryString;

class CategoryController extends ApiController
{
    public function __construct(){
        $this->model = new Category;
        $this->store_request = new StoreCategoryRequest;
        $this->update_request = new UpdateCategoryRequest;
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
    }
}
