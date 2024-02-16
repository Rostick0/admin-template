<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Utils\AccessUtil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $model;
    protected $is_auth_id = false;
    protected $fillable_block = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    private static function extendsMutation($data, $request)
    {
    }

    private static function getWhere()
    {
        return [];
    }


    public function index(Request $request)
    {
        return new JsonResponse(
            Filter::all($request, $this->model, $this->fillable_block, $this::getWhere())
        );
    }

    public function store(Request $request)
    {
        $create_data = [
            ...$request->validated(),
        ];

        if ($this->is_auth_id) $create_data['user_id'] = auth()->id();

        $data = $this->model::create($create_data);

        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $data->id, $this::getWhere())
        ], 201);
    }

    public function show(Request $request, int $id)
    {
        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $id, $this::getWhere())
        ]);
    }
    public function update(Request $request, int $id)
    {
        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('update', $data)) return AccessUtil::errorMessage();

        $data->update($request->validated());

        $this::extendsMutation($data, $request);

        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $id, $this::getWhere())
        ]);
    }

    public function destroy(int $id)
    {
        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('delete', $data)) return AccessUtil::errorMessage();

        $this->model::destroy($id);

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }
}