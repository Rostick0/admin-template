<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slide\StoreSlideRequest;
use App\Http\Requests\Slide\UpdateSlideRequest;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends ApiController
{
    public function __construct()
    {
        $this->model = new Slide;
        $this->store_request = new StoreSlideRequest;
        $this->update_request = new UpdateSlideRequest;
    }

    protected static function extendsMutation($data, $request)
    {
        if ($request->has('image')) {
            $data->image()->delete();

            $data->image()->create([
                'image_id' => $request->image
            ]);
        }
    }

    protected static function getWhere(Request $request = null)
    {
        $where = [];

        if (auth()->user()->role !== 'admin') {
            $where[] = ['is_show', '=', 1];
        }

        return $where;
    }
}
