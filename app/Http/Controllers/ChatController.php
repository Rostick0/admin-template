<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\StoreChatRequst;
use App\Models\Chat;
use App\Models\ChatUser;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function store(StoreChatRequst $request)
    {
        $model = $request->model::find($request->id);

        // dd($model->chats()->whereHas());
        $chat = ChatUser::whereHas(
            'chat',
            function (Builder $query) use ($model) {
                $query->where([
                    [
                        'chatable_type',
                        '=',
                        Product::class
                    ],
                    [
                        'chatable_id',
                        '=',
                        $model->id
                    ]
                ]);
            }
        )->where('user_id', $request->user()->id)->count();

        $chat_users = ChatUser::whereHas(
            'chat',
            function (Builder $query) use ($model) {
                $query->where([
                    [
                        'chatable_type',
                        '=',
                        Product::class
                    ],
                    [
                        'chatable_id',
                        '=',
                        $model->id
                    ]
                ]);
            }
        )->where('user_id', $request->user()->id)->count();
        // dd($model->user_id);
        // dd($model->chats->chat_users()->where('user_id', $request->user()->id));
        if ($chat_users || $request->user()->id === $model->user_id) {
            return new JsonResponse([
                'message' => 'You dont create'
            ], 400);
        }

        $chat = $model
            ->chats()
            ->create();

        $chat->chat_users()->createMany([
            [
                'chat_id' => $chat->id,
                'user_id' => $request->user()->id,
            ],
            [
                'chat_id' => $chat->id,
                'user_id' => $model->user_id,
            ]
        ]);

        return new JsonResponse([
            'message' => 'created'
        ]);
    }
}
