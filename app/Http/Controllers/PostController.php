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
