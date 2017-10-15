<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Weblink
 */
class Weblink extends Model
{
    protected $table = 'weblinks';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'category_id',
        'link',
        'img'
    ];

    protected $guarded = [];

}
