<?php

namespace App\Http\Controllers;

use App\Enum\StatusType;
use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filters\QueryString;

class PostController extends ApiController
{
    public function __construct()
    {
        $this->model = new Post;
        $this->is_auth_id = true;
        $this->store_request = new StorePostRequest;
        $this->update_request = new UpdatePostRequest;
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
    }

    protected static function getWhere(?Request $request = null)
    {
        $where = [];

        if ($request->user()?->role !== 'admin') {

            $where[] = ['status', '=', StatusType::publish];
        }

        return $where;
    }
}
