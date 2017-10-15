<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysInterval
 */
class SysInterval extends Model
{

    protected $table = 'sys_interval';

    public $timestamps = false;

    protected $fillable = [
        'start_day',
        'start_time',
        'end_time',
        'end_day'
    ];

    protected $guarded = [];


}
