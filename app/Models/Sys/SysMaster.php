<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysMaster
 */
class SysMaster extends Model
{
    protected $table = 'sys_master';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type'
    ];

    protected $guarded = [];


}
