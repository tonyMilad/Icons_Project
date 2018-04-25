<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Url;
use App\User;

class ApiStatusChanged extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Url $url)
    {
        $this->url=$url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user=$this->url->user()->get()->first();
        return $this->to($user->email)
            ->text('WebApp'.$this->url->url.'status code has been changed to'.$this->url->status);
    }
}
