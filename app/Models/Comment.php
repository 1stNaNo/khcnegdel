<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 */
class Comment extends Model
{
    protected $table = 'comment';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'comment',
        'post_id',
        'insert_date'
    ];

    protected $guarded = [];

    public function scopeByPostId($query, $id){
      $query->wherePost_id($id);
    }
}
