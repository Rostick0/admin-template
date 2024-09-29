<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreMessageRequest;
use App\Http\Requests\Message\UpdateMessageRequest;
use App\Models\ChatUser;
use App\Models\Message;
use App\Utils\AccessUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function read(Request $request, int $id)
    {
        $message = Filter::one($request, new Message, $id, $this::getWhere());

        if (!$message) return AccessUtil::errorMessage();

        Message::where([
            ['id', '<=', $id],
            ['chat_id', '=', $message->chat_id],
            ['user_id', '!=', auth()->id()],
        ])->update([
            'is_read' => 1
        ]);

        ChatUser::firstWhere([
            ['chat_id', '=', $message->chat_id],
            ['user_id', '=', auth()->id()],
        ])->update([
            'is_read' => 1
        ]);

        return new JsonResponse([
            'message' => 'read',
        ]);
    }
}
