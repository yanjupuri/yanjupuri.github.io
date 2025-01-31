<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name;
    public $replyUrl;

    public function __construct($full_name, $replyUrl)
    {
        $this->full_name = $full_name;
        $this->replyUrl = $replyUrl;
    }

    public function build()
    {
        return $this->subject('An admin has replied to your review.')
                    ->from('support@quickiefixtech.online', env('APP_NAME'))
                    ->view('forms.notification');
    }
}
