<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Filter;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index(Request $request)
    {
        return (new PostController)->index($request, 'pages.admin.post.create');
    }

    public function create()
    {
        return (new PostController)->create('pages.admin.post.create');
    }

    public function store(StorePostRequest $request)
    {
        return (new PostController)->store($request, '');
    }

    public function edit(int $id)
    {
        return (new PostController)->edit($id, 'pages.admin.post.edit');
    }

    public function update(UpdatePostRequest $request, int $id)
    {
        return (new PostController)->update($request, $id);
    }

    public function destroy(int $id)
    {
        return (new PostController)->destroy($id, '');
    }
}
