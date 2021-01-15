<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicket extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
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
        $agencyEmail = 'abrar.ul.haq87@gmail.com';
        $agencyName = $this->data['agency_customer']->name ? : 'TripGofer';
        return $this->view('agency.bookings.ticket')
            ->with($this->data)
            ->from($agencyEmail, $agencyName)
            ->subject('PNR has been generated')
            ->attach($this->data['ticket']);
    }
}
