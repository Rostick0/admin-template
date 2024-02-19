<?php

namespace App\Http\Controllers;

use App\Models\Ordering;
use App\Http\Requests\Ordering\StoreOrderingRequest;
use App\Http\Requests\Ordering\UpdateOrderingRequest;
use App\Utils\AccessUtil;
use Illuminate\Http\Request;

class OrderingController extends ApiController
{
    public function __construct()
    {
        $this->model = new Ordering;
        $this->is_auth_id = true;
        $this->store_request = new StoreOrderingRequest;
        $this->update_request = new UpdateOrderingRequest;
    }

    public function store(Request $request) {
        if (auth()->user()?->product_users()->count() == 0) return AccessUtil::errorMessage('Cart empty', 400);

        return parent::store($request);
    }
}
