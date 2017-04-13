<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleParagraph extends Model
{
    //
    //
    protected $table = 'article_paragraphs';
    public $timestamps = false;
    public $primaryKey = 'parID';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_en', 'content_sr', 'position'
    ];
    
    /**
     * Returns the article of the paragraph.
     *
     */
    public function article() {
        return $this->belongsTo('App\Article', 'artID', 'artID');
    }
}
