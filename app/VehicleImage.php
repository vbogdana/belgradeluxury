<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    //
    //
    protected $table = 'vehicle_images';
    public $timestamps = false;
    public $primaryKey = 'imgID';
}
