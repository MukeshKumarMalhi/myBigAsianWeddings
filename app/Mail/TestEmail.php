<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($data)
     {
       $this->data = $data;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->view('emails.test', ['data' => $this->data])
                ->from($this->data['useremail'], $this->data['username'])
                ->replyTo($this->data['useremail'], $this->data['username'])
                ->subject($this->data['subject']);
    }
}
