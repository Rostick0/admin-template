<?php

namespace App\Http\Controllers;

use App\Models\ProductUser;
use App\Http\Requests\ProductUser\StoreProductUserRequest;
use App\Http\Requests\ProductUser\UpdateProductUserRequest;

class ProductUserController extends ApiController
{
    public function __construct()
    {
        $this->model = new ProductUser;
        $this->is_auth_id = true;
        $this->store_request = new StoreProductUserRequest;
        $this->update_request = new UpdateProductUserRequest;
    }
}
