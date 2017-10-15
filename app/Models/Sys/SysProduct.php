<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysProduct
 */
class SysProduct extends Model
{
    protected $table = 'sys_product';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'split',
        'cat'
    ];

    protected $guarded = [];


}
