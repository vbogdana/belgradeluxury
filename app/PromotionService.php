<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionService extends Model
{
    //
    //
    protected $table = 'promotion_services';
    public $timestamps = false;
    public $primaryKey = 'prmsID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr', 'optional'
    ];
    
    public function promotion() {
        return $this->belongsTo('App\Promotion', 'promID', 'promID');
    }
    
    public function service() {
        return $this->belongsTo('App\Service', 'servID', 'servID');
    }
}
