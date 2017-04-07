<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Place;
use App\Seating;
use App\Event;

class Reservation extends Mailable
{
    use Queueable, SerializesModels;
    
    public $name;
    public $phone;
    public $place;
    public $date;
    public $time;
    public $people;
    public $seating;
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
        $this->phone = $data['phone'];        
        $this->place = $data['place'];                
        $this->date = $data['date'];
        $this->time = $data['time'];
        $this->people = $data['people']; 
        $this->seating = $data['seating'];        
        $this->content = $data['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("ONLINE REZERVACIJA --- ".$this->place);
        return $this->view('emails.reservation');
    }
}
