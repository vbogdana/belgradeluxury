<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model
{
    //
    protected $table = 'hosts';
    public $timestamps = false;
    public $primaryKey = 'hostID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'skills_en', 'skills_sr',
        'hobbies_en', 'hobbies_sr', 
    ];
}
