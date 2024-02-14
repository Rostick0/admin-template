<?php

namespace App\Http\Controllers\Client;

use App\Filters\Filter;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Http\Request;

class ClientPostController extends Controller
{
    public function index(Request $request)
    {
        return (new PostController)->index($request, 'pages.client.post.index');
    }

    public function create()
    {
        return (new PostController)->create('pages.client.post.create');
    }

    public function store(StorePostRequest $request)
    {
        return (new PostController)->store($request, '');
    }

    public function show(int $id)
    {
        return (new PostController)->show($id, 'pages.client.post.show');
    }

    public function edit(int $id)
    {
        return (new PostController)->edit($id, 'pages.client.post.edit');
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
