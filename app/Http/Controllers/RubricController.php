<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Models\Rubric;
use App\Http\Requests\StoreRubricRequest;
use App\Http\Requests\UpdateRubricRequest;
use App\Utils\AccessUtil;
use Illuminate\Http\Request;

class RubricController extends ApiController
{
    public function __construct(){
        $this->model = new Rubric;
    }

    protected static function getWhere()
    {
        $where = [];

        return $where;
    }
}
