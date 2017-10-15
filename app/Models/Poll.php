<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Poll
 */
class Poll extends Model
{
    protected $table = 'polls';

    public $timestamps = false;

    protected $fillable = [
        'title_sid',
        'insert_date',
        'insert_user',
        'update_date',
        'update_user',
        'active_flag'
    ];

    protected $guarded = [];

        
}