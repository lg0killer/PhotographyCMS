<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\EmailAudit;

class EmailAuditSentMessage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $data = EmailAudit::parseEvent($event->message);
        $data['status'] = 'sent';
        $data['sent'] = true;
        EmailAudit::updateOrCreate(['message_id' => $data['message_id']], $data);
    }
}
