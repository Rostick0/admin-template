<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoticeController extends ApiController
{
    public function __construct()
    {
        $this->model = new Notice;
    }

    public function readAll(Request $request)
    {
        $request->user()->notices()->where([
            ['is_read', '=', 0],
        ])->update([
            'is_read' => 1
        ]);

        return new JsonResponse([
            'message' => 'Readed'
        ]);
    }

    public function read(Request $request, int $id)
    {
        $request->user()->notices()->where([
            ['id', '=', $id],
            ['is_read', '=', 0],
        ])->update([
            'is_read' => 1
        ]);

        return new JsonResponse([
            'message' => 'Readed'
        ]);
    }
}
