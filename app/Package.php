<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    //
    //
    public $timestamps = false;
    public $primaryKey = 'packID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr', 'price', 
        'description_en', 'description_sr',
        'long_description_en', 'long_description_sr',
        'position',
        'cardFront', 'cardBack', 'symbol'
    ];
    
    /**
     * Returns all services included in the package.
     *
     */
    public function services() {
        return $this->hasMany('App\PackageService', 'packID', 'packID');
    }

    /**
     * Returns mandatory services included in the package.
     *
     */
    public function included_services() {
        return $this->hasMany('App\PackageService', 'packID', 'packID')->where('optional', '0');
    }

    /**
     * Returns optional services included in the promotion.
     *
     */
    public function optional_services() {
        return $this->hasMany('App\PackageService', 'packID', 'packID')->where('optional', '1');
    }
}
