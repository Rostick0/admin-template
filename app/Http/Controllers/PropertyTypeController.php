<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyType\StorePropertyTypeRequest;
use App\Http\Requests\PropertyType\UpdatePropertyTypeRequest;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends ApiController
{
    public function __construct()
    {
        $this->model = new PropertyType;
        $this->store_request = new StorePropertyTypeRequest;
        $this->update_request = new UpdatePropertyTypeRequest;
    }
}
