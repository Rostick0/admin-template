<?php

namespace App\Http\Controllers;

use App\Models\ProductProperty;
use Illuminate\Http\Request;

class ProductPropertyController extends ApiController
{
    public function __construct()
    {
        $this->model = new ProductProperty;
    }
}
