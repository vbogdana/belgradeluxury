<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testemonial extends Model
{
    //
    protected $table = 'testemonials';
    public $timestamps = false;
    public $primaryKey = 'testID';
}
