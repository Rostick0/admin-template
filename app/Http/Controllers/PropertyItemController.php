<?php

namespace App\Http\Controllers;

use App\Models\PropertyItem;
use App\Http\Requests\PropertyItem\StorePropertyItemRequest;
use App\Http\Requests\PropertyItem\UpdatePropertyItemRequest;

class PropertyItemController extends ApiController
{
    public function __construct()
    {
        $this->model = new PropertyItem;
        $this->store_request = new StorePropertyItemRequest;
        $this->update_request = new UpdatePropertyItemRequest;
    }
}
