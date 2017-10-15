<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Title
 */
class Title extends Model
{
    protected $table = 'title';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'body'
    ];

    protected $guarded = [];
}
