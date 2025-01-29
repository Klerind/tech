<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request = null;

    public function __construct(
            $request 
            )
    {
      $this->request = $request; 
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $request = $this->request->input();
      
        return new Envelope(
           subject: $request['subject'], 
           replyTo: [
                new Address($request['email'], 'Taylor Otwell'),
                ],
        );
        
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
          view: 'pages.newEmptyPHP',
         );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    { //dd(fromStorage('laravel/public/albill.png'));
        return [
            Attachment::fromStorage('iindex.jpeg')
        ];
    }
}
