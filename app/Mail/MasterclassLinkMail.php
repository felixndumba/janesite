<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MasterclassLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $youtubeId;

    public function __construct($title, $youtubeId)
    {
        $this->title = $title;
        $this->youtubeId = $youtubeId;
    }

    public function build()
    {
        return $this
            ->subject('Your Masterclass: ' . $this->title)
            ->view('emails.masterclass-link');
    }
}