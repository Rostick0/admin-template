<?php

namespace App\Observers;

use App\Events\Notice as EventsNotice;
use App\Models\Notice;

class NoticeObserver
{
    /**
     * Handle the Notice "created" event.
     */
    public function created(Notice $notice): void
    {
        // if (!$notice->date_publication) {
        //     EventsNotice::dispatch([
        //         'data' => [
        //             ...$notice->toArray(),
        //             // 'notice_relat' => [
        //             //     ...$notice?->notice_relat?->toArray(),
        //             //     'noticeable' => [
        //             //         ...$notice?->notice_relat?->notice_relseable?->toArray(),
        //             //     ]
        //             // ]
        //         ],
        //         'type' => 'create'
        //     ]);
        // }
    }

    /**
     * Handle the Notice "updated" event.
     */
    public function updated(Notice $notice): void
    {
        //
    }

    /**
     * Handle the Notice "deleted" event.
     */
    public function deleted(Notice $notice): void
    {
        //
    }

    /**
     * Handle the Notice "restored" event.
     */
    public function restored(Notice $notice): void
    {
        //
    }

    /**
     * Handle the Notice "force deleted" event.
     */
    public function forceDeleted(Notice $notice): void
    {
        //
    }
}
