<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;
    
    public $name;
    public $email;
    public $country;
    public $subject;
    public $company;
    public $website;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->country = $data['country'];
        switch ($data['subject']) {
            case 'client': $this->subject = "ONLINE KONTAKT --- Korisnička podrška"; break;
            case 'business': 
                $this->subject = "ONLINE KONTAKT --- Poslovna saradnja";
                $this->company = $data['company'];
                $this->website = $data['website'];
                break;
            case 'careers': $this->subject = "ONLINE KONTAKT --- Karijera u BELUXu"; break;
        }        
        $this->content = $data['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->subject);
        return $this->view('emails.contact');
    }
}
