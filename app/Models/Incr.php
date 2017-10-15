<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Incr
 */
class Incr extends Model
{
    protected $table = 'incr';

    public $timestamps = false;

    protected $fillable = [
        'value'
    ];

    protected $guarded = [];

        
}