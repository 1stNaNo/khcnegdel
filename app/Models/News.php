<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 */
class News extends Model
{
    protected $table = 'news';

    public $timestamps = false;

    protected $fillable = [
        'title_sid',
        'content_sid',
        'thumbnail',
        'slide',
        'have_comment',
        'active_flag',
        'insert_user',
        'insert_date',
        'update_user',
        'update_date',
        'views'
    ];

    protected $guarded = [];

    public function scopeDeleteById($query, $id){
        $query->whereId($id)->delete();
    }

}
