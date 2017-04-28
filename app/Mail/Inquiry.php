<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Lang;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;
    
    public $name;
    public $phone;
    public $email;
    public $service;
    public $object;
    public $date_start;
    public $date_end;
    public $people;
    public $content;
    public $route;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->name = $data['name'];
        $this->phone = $data['phone'];        
        $this->email = $data['email'];                
        $this->date_start = $data['date_start'];
        $this->date_end = $data['date_end'];
        $this->people = $data['people']; 
        $this->service = $data['service'];
        $this->object = $data['object'];
        $this->content = $data['message'];
        $this->route = $data['route'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("ONLINE UPIT - ".Lang::get('common.'.$this->service, array(), 'sr')." --- ".$this->object);
        return $this->view('emails.inquiry');
    }
}
