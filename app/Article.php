<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    //
    public $timestamps = false;
    public $primaryKey = 'artID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr', 
        'description_en', 'description_sr',
    ];
    
    /**
     * Returns the category of the article.
     *
     */
    public function category() {
        return $this->belongsTo('App\Category', 'ctgID', 'ctgID');
    }
    
    /**
     * Returns the author of the article.
     *
     */
    public function author() {
        return $this->belongsTo('App\User', 'userID', 'userID');
    }
    
    public function event() {
        return $this->hasOne('App\Event', 'artID', 'artID');
    }
}
