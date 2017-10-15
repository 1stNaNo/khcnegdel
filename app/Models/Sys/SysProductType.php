<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysProductType
 */
class SysProductType extends Model
{
    protected $table = 'sys_product_type';

    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'name',
        'numb'
    ];

    protected $guarded = [];


}
