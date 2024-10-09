<?php

namespace App\Http\Controllers;

use App\Models\OrderingProduct;
use Illuminate\Http\Request;

class OrderingProductController extends ApiController
{
    public function __construct()
    {
        $this->model = new OrderingProduct;
    }

    protected static function getWhere(?Request $request = null)
    {
        $where = [];

        if ($request->user()?->role !== 'admin') {

            $where[] = ['ordering.user_id', '=', $request->user()?->id];
        }

        return $where;
    }
}
