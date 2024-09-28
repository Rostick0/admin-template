<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Utils\AccessUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends ApiController
{
    public function __construct()
    {
        $this->model = new Comment;
        $this->store_request = new StoreCommentRequest;
        $this->update_request = new UpdateCommentRequest;
        $this->is_auth_id  = true;
    }

    public function store(Request $request)
    {
        if ($this->store_request && !($this->store_request)->authorize() && AccessUtil::cannot('store', $this->model)) return AccessUtil::errorMessage();

        $create_data = [...$request->validate(
            ($this->store_request)->rules($request->all())
        )];

        if ($this->is_auth_id) $create_data[$this->string_user_id] = auth()->id();

        $data = $request->model::find($request->id)
            ->comments()
            ->create($create_data);

        $this::extendsMutation($data, $request);

        return new JsonResponse([
            'data' => $data,
        ], 201);
    }
}
