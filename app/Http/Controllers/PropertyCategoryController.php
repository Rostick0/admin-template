<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyCategory\StorePropertyCategoryRequest;
use App\Http\Requests\PropertyCategory\UpdatePropertyCategoryRequest;
use App\Models\PropertyCategory;
use Illuminate\Http\Request;

class PropertyCategoryController extends ApiController
{
    public function __construct()
    {
        $this->model = new PropertyCategory;
        $this->store_request = new StorePropertyCategoryRequest;
        $this->update_request = new UpdatePropertyCategoryRequest;
    }
}
