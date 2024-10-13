<?php

namespace App\Http\Controllers;

use App\Models\PropertyValue;
use Illuminate\Http\Request;

class PropertyValueController extends ApiController
{
    public function __construct()
    {
        $this->model = new PropertyValue;
    }
}
