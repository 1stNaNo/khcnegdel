<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 */
class Answer extends Model
{
    protected $table = 'answers';

    public $timestamps = false;

    protected $fillable = [
        'poll_id',
        'text_sid',
        'total'
    ];

    protected $guarded = [];


}
