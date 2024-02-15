<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Models\Rubric;
use App\Http\Requests\StoreRubricRequest;
use App\Http\Requests\UpdateRubricRequest;
use App\Utils\AccessUtil;
use Illuminate\Http\Request;

class RubricController extends WebController
{
    public function __construct(){
        $this->model = new Rubric;
        $this->name_datas = 'rubrics';
        $this->name_data = 'rubric';
    }

    protected static function getWhere()
    {
        $where = [];

        return $where;
    }
}
