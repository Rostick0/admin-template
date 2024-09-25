<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\Vendor\StoreVendorRequest;
use App\Http\Requests\Vendor\UpdateVendorRequest;
use Rostislav\LaravelFilters\Filters\QueryString;

class VendorController extends ApiController
{
    public function __construct()
    {
        $this->model = new Vendor;
        $this->store_request = new StoreVendorRequest;
        $this->update_request = new UpdateVendorRequest;
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
