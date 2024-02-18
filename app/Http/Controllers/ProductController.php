<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    public function __construct()
    {
        $this->model = new Product;
        $this->is_auth_id = true;
        $this->store_request = new StoreProductRequest;
        $this->update_request = new UpdateProductRequest;
    }

    // public function store(StoreProductRequest $request)
    // {
    //     return parent::store($request);
    //     // return (new ApiController($this->model))->store($request);
    // }
}
