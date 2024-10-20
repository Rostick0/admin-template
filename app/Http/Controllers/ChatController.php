<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\StoreChatRequst;
use App\Models\Chat;
use App\Models\ChatUser;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filter;

class ChatController extends Controller
{
    protected $model;
    protected $fillable_block = [];
    protected $q_request  = [];
    
    public function __construct()
    {
        $this->model = new Chat;
    }

    protected static function getWhere(Request $request)
    {
        return [];
    }

    public function index(Request $request)
    {
        return new JsonResponse(
            Filter::all($request, $this->model, $this->fillable_block, $this::getWhere($request), $this->q_request)
        );
    }

    public function store(StoreChatRequst $request)
    {
        $model = $request->model::find($request->id);

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

    public function show(Request $request, int $id)
    {
        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $id, $this::getWhere($request))
        ]);
    }
}
