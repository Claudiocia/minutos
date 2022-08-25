<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailNews extends Mailable
{
    use Queueable, SerializesModels;
    public $mailNews;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailNews)
    {
        $this->mailNews = $mailNews;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendEmailNews')
            ->with('mailNews', $this->mailNews);
    }
}
