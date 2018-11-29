<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceInquiry extends Model
{
    //
    protected $table = 'services_inquiries';
    public $timestamps = false;
    public $primaryKey = 'inqID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name', 'phone', 'email', 'date_start', 'date_end', 'service', 'people', 'message', 'price'
    ];
    
}
