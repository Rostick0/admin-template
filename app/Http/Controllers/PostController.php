<?php

namespace App\Http\Controllers;

use App\Filters\Filter;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Utils\AccessUtil;
use App\Utils\QueryString;
use Illuminate\Http\Request;

class PostController extends WebController
{
    public function __construct(){
        $this->model = new Post;
        $this->name_datas = 'posts';
        $this->name_data = 'post';
    }

    protected static function extendsMutation($data, $request)
    {
        $data->images()->delete();
        if ($request->has('images')) {
            $images = array_map(function ($image_id) {
                return ['image_id' => $image_id];
            }, QueryString::convertToArray($request->images));

            $data->images()->createMany($images);
        }
    }

    // protected static function getWhere()
    // {
    //     $where = [];

    //     return $where;
    // }

    // public function index(Request $request, $view)
    // {
    //     $posts = Filter::all($request, new Post, [], $this::getWhere());

    //     return view($view, compact('posts'));
    // }

    // public function create($view)
    // {
    //     return view($view);
    // }

    // public function store(StorePostRequest $request, $route_name)
    // {
    //     $post = Post::create([
    //         ...$request->validated(),
    //         'user_id' => auth()->id()
    //     ]);

    //     $this::extendsMutation($post, $request);

    //     return redirect()->route($route_name, [
    //         'post' => $post->id
    //     ])->with('success', '');
    // }

    // public function show(int $id, $view)
    // {
    //     $post = Post::findOrFail($id);

    //     return view($view, compact('post'));
    // }

    // public function edit(int $id, $view)
    // {
    //     $post = Post::findOrFail($id);

    //     return view($view, compact('post'));
    // }

    // public function update(UpdatePostRequest $request, int $id)
    // {
    //     $post = Post::findOrFail($id);

    //     if (AccessUtil::cannot('update', $post)) return AccessUtil::errorMessage();

    //     $post->update($request->validated());

    //     $this::extendsMutation($post, $request);

    //     return redirect()->back()->with('success', 'Пост успешно изменен');
    // }

    // public function destroy(int $id, $route_name)
    // {
    //     $post = Post::findOrFail($id);

    //     if (AccessUtil::cannot('delete', $post)) return AccessUtil::errorMessage();

    //     Post::destroy($id);

    //     return redirect()->route($route_name)->with('success', 'Успешно удалено');
    // }
}
