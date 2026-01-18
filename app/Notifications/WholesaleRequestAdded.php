<?php

namespace App\Notifications;

use App\Models\WholesaleRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WholesaleRequestAdded extends Notification
{
    use Queueable;

    public function __construct(private readonly WholesaleRequest $wholesaleRequest)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $name = $this->wholesaleRequest->name;
        $productTitle = optional($this->wholesaleRequest->product)->title;

        $title = 'Wholesale added';
        if ($productTitle) {
            $title .= ': ' . $productTitle;
        }
        if ($name) {
            $title .= ' (' . $name . ')';
        }

        return [
            'title' => $title,
            'fas' => 'fa-handshake',
            'actionURL' => route('wholesale-requests.index'),
            'url' => route('wholesale-requests.index'),
            'wholesale_request_id' => $this->wholesaleRequest->id,
        ];
    }
}
