<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //
    //
    public $timestamps = false;
    public $primaryKey = 'promID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'meta_en', 'meta_sr',
        'title_en', 'title_sr', 
        'url_en', 'url_sr',
        'description_en', 'description_sr',
        'long_description_en', 'long_description_sr',
        'image', 'background_image'
    ];
    
    /**
     * Returns all services included in the promotion.
     *
     */
    public function services() {
        return $this->hasMany('App\PromotionService', 'promID', 'promID');
    }

    /**
     * Returns mandatory services included in the promotion.
     *
     */
    public function included_services() {
        return $this->hasMany('App\PromotionService', 'promID', 'promID')->where('optional', '0');
    }

    /**
     * Returns optional services included in the promotion.
     *
     */
    public function optional_services() {
        return $this->hasMany('App\PromotionService', 'promID', 'promID')->where('optional', '1');
    }
}
