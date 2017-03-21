<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';
    public $timestamps = false;
    public $primaryKey = 'evID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'day', 'title_en', 'title_sr', 'date', 'reservations'
    ];
    
    public function getDay() {
        $strings = [ 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ];
        return $strings[$this->day];
    }
    
}
