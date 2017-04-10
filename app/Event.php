<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;

class Event extends Model
{
    //
    protected $table = 'events';
    public $timestamps = false;
    public $primaryKey = 'evID';
    private $tmpDate;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'reservations'
    ];
    
    /**
     * Returns the day of the week for the event.
     *
     */
    public function getDay() {
        $strings = [ 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday' ];
        if ($this->tmpDate === null) {
            $this->tmpDate = Carbon::createFromFormat('Y-m-d', $this->date);
        }
        $day = $this->tmpDate->dayOfWeek;
        return Lang::get('common.'.$strings[$day]);
    }
    
    /**
     * Returns the day of the month for the event.
     *
     */
    public function getDate() {
        if ($this->tmpDate === null) {
            $this->tmpDate = Carbon::createFromFormat('Y-m-d', $this->date);
        }
        return $this->tmpDate->day;
    }
    
    /**
     * Returns the month for the event.
     *
     */
    public function getMonth() {
        $strings = [ 'january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december' ];
        if ($this->tmpDate === null) {
            $this->tmpDate = Carbon::createFromFormat('Y-m-d', $this->date);
        }
        $month = $strings[$this->tmpDate->month - 1];
        return Lang::get('common.'.$month);
    }
    
    /**
     * Returns the year for the event.
     *
     */
    public function getYear() {
        if ($this->tmpDate === null) {
            $this->tmpDate = Carbon::createFromFormat('Y-m-d', $this->date);
        }
        return $this->tmpDate->year;
    }
    
    public function place() {
        return $this->belongsTo('App\Place', 'placeID', 'placeID');
    }
    
    public function article() {
        return $this->belongsTo('App\Article', 'artID', 'artID');
    }
    
}
