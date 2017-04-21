<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceText extends Model
{
    //
    protected $table = 'service_texts';
    public $timestamps = false;
    public $primaryKey = 'textID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr',
        'subtitle1_en', 'subtitle1_sr',
        'subtitle2_en', 'subtitle2_sr',
        'content_en', 'content_sr'
        
    ];
}
