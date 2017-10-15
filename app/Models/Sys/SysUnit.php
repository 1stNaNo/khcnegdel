<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysUnit
 */
class SysUnit extends Model
{
    protected $table = 'sys_unit';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'master_id'
    ];

    protected $guarded = [];


}
