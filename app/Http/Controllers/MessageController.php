<?php

namespace App\Http\Controllers;

use App\Events\Message as EventsMessage;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Models\ChatUser;
use App\Models\Message;
use App\Utils\AccessUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rostislav\LaravelFilters\Filter;
use Rostislav\LaravelFilters\Filters\QueryString;

class MessageController extends ApiController
{
    public function __construct()
    {
        $this->model = new Message;
        $this->store_request = new StoreMessageRequest;
        $this->update_request = new UpdateMessageRequest;
        $this->is_auth_id = true;
    }

    protected static function getWhere(Request $request = null)
    {
        $where = [];

        if (auth()?->user()?->role !== 'admin') {
            $where[] = ['user_id', '=', auth()?->id(), 'chat.chat_users'];
        }

        return $where;
    }

    protected static function extendsMutation($data, $request)
    {
        if ($request->has('images')) {
            $data->images()->delete();
            $images = array_map(function ($image_id) {
                return ['image_id' => $image_id];
            }, QueryString::convertToArray($request->images));

            $data->images()->createMany($images);
        }

        if ($request->has('files')) {
            $data->files()->delete();
            $files = array_map(function ($file_id) {
                return ['file_id' => $file_id];
            }, QueryString::convertToArray($request->files));

            $data->files()->createMany($files);
        }
    }

    public function store(Request $request)
    {
        if (!($this->store_request)->authorize() && AccessUtil::cannot('store', $this->model)) return AccessUtil::errorMessage();

        // данные для создания записи
        $create_data =   [...$request->validate(
            ($this->store_request)->rules($request->all())
        )];

        if ($this->is_auth_id) $create_data[$this->string_user_id] = auth()->id();

        $data = $this->model::create($create_data);

        $this::extendsMutation($data, $request);

        $data = Message::with(['images.image', 'files.file', 'chat.chat_interlocutor.user'])
            ->find($data->id);

        EventsMessage::dispatch([
            'data' => $data,
            'type' => 'create'
        ]);

        return new JsonResponse([
            'data' => $data
        ], 201);
    }

    public function update(Request $request, int $id)
    {
        if (!($this->update_request)->authorize()) return AccessUtil::errorMessage();

        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('update', $data)) return AccessUtil::errorMessage();

        $data->update(
            $request->validate(($this->update_request)->rules([
                ...$request->all(),
                'id' => $id
            ]))
        );

        $this::extendsMutation($data, $request);

        $data = Message::with(['images.image', 'files.file', 'chat.chat_interlocutor.user'])
            ->find($data->id);

        EventsMessage::dispatch([
            'data' => $data,
            'type' => 'update'
        ]);

        return new JsonResponse([
            'data' => $data
        ]);
    }

    public function read(Request $request, int $id)
    {
        $message = Filter::one($request, new Message, $id, $this::getWhere());

        if (!$message) return AccessUtil::errorMessage();

        Message::where([
            ['id', '<=', $id],
            ['chat_id', '=', $message->chat_id],
            ['user_id', '!=', auth()->id()],
        ])->update([
            'is_read' => 1,
            'updated_at' => DB::raw('updated_at')
        ]);

        ChatUser::firstWhere([
            ['chat_id', '=', $message->chat_id],
            ['user_id', '=', auth()->id()],
        ])->update([
            'is_read' => 1,
            'updated_at' => DB::raw('updated_at')
        ]);

        return new JsonResponse([
            'message' => 'read',
        ]);
    }
}
