<?php

namespace App\Http\Controllers;

use App\Models\ProductDatePrice;
use Illuminate\Http\Request;

class ProductDatePriceController extends ApiController
{
    public function __construct()
    {
        $this->model = new ProductDatePrice;
    }
}
