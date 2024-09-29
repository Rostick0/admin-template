<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        private $data
    ) {}

    public function broadcastWith()
    {
        return $this->data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // return [new PrivateChannel('message.2')];
        $chat = Chat::find($this->data['data']['chat_id'] ?? null);

        $channels = [];

        foreach ($chat->chat_users ?? [] as $user) {
            // $channels[] = new Channel('message.' . $user->user_id);
            $channels[] = new PrivateChannel('message.' . $user->user_id);
        }

        return $channels;
    }
}
