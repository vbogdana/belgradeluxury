<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageService extends Model
{
    //
    //
    protected $table = 'package_services';
    public $timestamps = false;
    public $primaryKey = 'pcksID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_en', 'title_sr'
    ];
    
    public function package() {
        return $this->belongsTo('App\Package', 'packID', 'packID');
    }
    
    public function service() {
        return $this->belongsTo('App\Service', 'servID', 'servID');
    }
}
