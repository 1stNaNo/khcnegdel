<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsCat
 */
class NewsCat extends Model
{
    protected $table = 'news_cat';

    public $timestamps = false;

    protected $fillable = [
        'cat_id',
        'news_id'
    ];

    protected $guarded = [];

    public function scopeByNewsId($query, $news_id){
      $query->whereNews_id($news_id);
    }

    public function scopeDeleteByNewsId($query, $news_id){
      $query->whereNews_id($news_id)->delete();
    }
}
