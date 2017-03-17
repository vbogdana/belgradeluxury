<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceImage extends Model
{
    //
    //
    protected $table = 'place_images';
    public $timestamps = false;
    public $primaryKey = 'imgID';
}
