<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testemonial extends Model
{
    //
    protected $table = 'testemonials';
    public $timestamps = false;
    public $primaryKey = 'testID';
    
    protected $fillable = ['content_en', 'content_sr', 'author', 'profession_en', 'profession_sr'];
}
