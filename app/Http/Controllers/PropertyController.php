<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Http\Requests\Property\StorePropertyRequest;
use App\Http\Requests\Property\UpdatePropertyRequest;

class PropertyController extends ApiController
{
    public function __construct()
    {
        $this->model = new Property;
        $this->store_request = new StorePropertyRequest;
        $this->update_request = new UpdatePropertyRequest;
    }
}
