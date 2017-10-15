<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Image
 */
class Img extends Model
{
    protected $table = 'images';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'path',
        'type',
        'insert_date',
        'insert_user'
    ];

    protected $guarded = [];

    public function scopeByType($query, $type){
      $query->whereType($type)->orderBy('insert_date','desc');
    }
}
