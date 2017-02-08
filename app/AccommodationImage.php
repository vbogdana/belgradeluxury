<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccommodationImage extends Model
{
    //
    //
    protected $table = 'accommodation_images';
    public $timestamps = false;
    public $primaryKey = 'imgID';
}
