<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Models\Rubric;
use App\Http\Requests\Rubric\StoreRubricRequest;
use App\Http\Requests\Rubric\UpdateRubricRequest;
use App\Utils\AccessUtil;
use Illuminate\Http\Request;

class RubricController extends ApiController
{
    public function __construct(){
        $this->model = new Rubric;
        $this->store_request = new StoreRubricRequest;
        $this->update_request = new UpdateRubricRequest;
    }

    protected static function getWhere()
    {
        $where = [];

        return $where;
    }
}
