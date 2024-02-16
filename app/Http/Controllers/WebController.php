<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Utils\AccessUtil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class WebController extends Controller
{
    protected $model;
    protected $name_datas = 'datas';
    protected $name_data = 'data';
    protected $is_auth_id = false;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected static function extendsMutation($data, $request)
    {
    }

    protected static function getWhere()
    {
        return [];
    }

    public function index(Request $request, string $view)
    {
        return view($view, [
            $this->name_datas => Filter::all($request, $this->model, [], $this::getWhere())
        ]);
    }

    public function create($view)
    {
        return view($view);
    }

    public function store(Request $request, string $route_name)
    {
        $create_data = [
            ...$request->validated(),
        ];

        if ($this->is_auth_id) $create_data['user_id'] = auth()->id();

        $data = $this->model::create($create_data);

        $this::extendsMutation($data, $request);

        return redirect()->route($route_name, [
            $this->name_data => $data->id
        ])->with('success', '');
    }

    public function show(int $id, string $view)
    {
        return view($view, [
            $this->name_data => $this->model::findOrFail($id)
        ]);
    }

    public function edit(int $id, $view)
    {
        return view($view, [
            $this->name_data => $this->model::findOrFail($id)
        ]);
    }

    public function update(Request $request, int $id)
    {
        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('update', $data)) return AccessUtil::errorMessage();

        $data->update($request->validated());

        $this::extendsMutation($data, $request);

        return redirect()->back()->with('success', 'Успешно изменено');
    }

    public function destroy(int $id, string $route_name, array $params = [])
    {
        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('delete', $data)) return AccessUtil::errorMessage();

        $this->model::destroy($id);

        return redirect()->route($route_name, $params)->with('success', 'Успешно удалено');
    }
}
