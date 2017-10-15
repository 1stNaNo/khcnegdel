<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysAddress
 */
class SysAddress extends Model
{
    protected $table = 'sys_address';

    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'name',
        'insert_date',
        'insert_user'
    ];

    protected $guarded = [];


}
