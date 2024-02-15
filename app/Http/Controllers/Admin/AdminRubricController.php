<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RubricController;
use App\Http\Requests\Rubric\StoreRubricRequest;
use App\Http\Requests\Rubric\UpdateRubricRequest;
use Illuminate\Http\Request;

class AdminRubricController extends Controller
{
    public function index(Request $request)
    {
        return (new RubricController)->index($request, 'pages.admin.rubric.index');
    }

    public function create()
    {
        return (new RubricController)->create('pages.admin.rubric.create');
    }

    public function store(StoreRubricRequest $request)
    {
        return (new RubricController)->store($request, 'admin.rubrics.edit');
    }

    public function edit(int $id)
    {
        return (new RubricController)->edit($id, 'pages.admin.rubric.edit');
    }

    public function update(UpdateRubricRequest $request, int $id)
    {
        return (new RubricController)->update($request, $id);
    }

    public function destroy(int $id)
    {
        return (new RubricController)->destroy($id, 'admin.rubrics.index');
    }
}
