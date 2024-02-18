<?php

namespace App\Http\Controllers;

use App\Models\Ordering;
use App\Http\Requests\Ordering\StoreOrderingRequest;
use App\Http\Requests\Ordering\UpdateOrderingRequest;

class OrderingController extends ApiController
{
    public function __construct()
    {
        $this->model = new Ordering;
        $this->is_auth_id = true;
        $this->store_request = new StoreOrderingRequest;
        $this->update_request = new UpdateOrderingRequest;
    }
}
