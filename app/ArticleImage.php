<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    //
    //
    protected $table = 'article_images';
    public $timestamps = false;
    public $primaryKey = 'imgID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'caption_en', 'caption_sr', 'credit', 'position'
    ];
    
    /**
     * Returns the article of the image.
     *
     */
    public function article() {
        return $this->belongsTo('App\Article', 'artID', 'artID');
    }
}
