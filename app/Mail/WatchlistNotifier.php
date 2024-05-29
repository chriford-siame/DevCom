<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WatchlistNotifier extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $current_user_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $email_from)
    {
        $this->request = $request;
        $this->current_user_email = $email_from;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(  )
    {
        // print $this->request;
        return $this
        ->view('email.custom_body_template')
        // ->with([
        //     'name' => 'name',
            // 'email_to' => $this->request->email,
            // 'message' => $this->request->message,
            // 'subject' => $this->request->subject,
        // ])
        ->from("developersiame@gmail.com")
        ->to('developersiame@gmail.com')
        ->subject('Add template here');
        // ->attachFromStorage('public/images/abcd.jpg')
    }
}
