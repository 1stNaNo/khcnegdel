<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Shorter
 */
class Shorter extends Model
{
    protected $table = 'shorter';

    public $timestamps = false;

    protected $fillable = [
        'content_sid',
        'target',
        'url',
        'show',
        'active_flag',
        'insert_user',
        'insert_date',
        'update_user',
        'update_date'
    ];

    protected $guarded = [];

        
}