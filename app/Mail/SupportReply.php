<?php

namespace App\Mail;

use App\Support;
use App\SupportReply as SupportReplyModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportReply extends Mailable
{
    use Queueable, SerializesModels;

    public $support;

    public $reply;

    public $lastMessage;

    /**
     * Create a new message instance.
     *
     * @param Support $support
     * @param SupportReplyModel $reply
     */
    public function __construct(Support $support, SupportReplyModel $reply)
    {
        $this->support = $support;
        $this->reply = $reply;
        $this->lastMessage = $this->getLastMessage();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Support Reply from ' . config('app.name'))
            ->markdown('email.support_reply');
    }

    private function getLastMessage()
    {
        // Check if this support iem has a previous reply, and use that
/*        $last = SupportReplyModel::query()->where('support_id', $this->support->id)
            ->whereKeyNot($this->reply->id)
            ->latest()->first();

       if (! is_null($last)) {
           return $last;
       }*/

       // There's no reply for this message, so just use the support message it self
        return $this->support;
    }
}
