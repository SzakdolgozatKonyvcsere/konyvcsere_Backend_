<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExchangePartnerMail extends Mailable
{
    use Queueable, SerializesModels;
        public $details;
    /**
     * Create a new message instance.
     *  @param array $details
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     */

    public function build()
    {
        return $this->subject('Sikeres könyvcsere – partner adatai')
        ->view('emails.exchangepartner')
        ->with([
            'partner_name' => $this->details['partner_name'],
            'partner_email' => $this->details['partner_email'],
            'partner_tel' => $this->details['partner_tel'],
        ]);
    }

}
