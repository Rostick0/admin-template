<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatUser\UpdateChatUserRequst;
use App\Models\ChatUser;
use Illuminate\Http\Request;

class ChatUserController extends ApiController
{
    public function __construct()
    {
        $this->model = new ChatUser;
        $this->update_request = new UpdateChatUserRequst;
        $this->is_auth_id = true;
    }
}
