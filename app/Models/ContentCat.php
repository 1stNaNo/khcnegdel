<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentCat
 */
class ContentCat extends Model
{
    protected $table = 'content_cat';

    public $timestamps = false;

    protected $fillable = [
        'content_name',
        'cat_id'
    ];

    protected $guarded = [];

}
