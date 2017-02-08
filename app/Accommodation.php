<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    //
    protected $table = 'accommodation';
    public $timestamps = false;
    public $primaryKey = 'accID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*
    protected $fillable = [
        'title_en', 'title_ser', 'address', 'description_en', 'description_ser', 'image', 'geoWidth', 'geoHeight', 'link'
    ];
     * 
     */
}
