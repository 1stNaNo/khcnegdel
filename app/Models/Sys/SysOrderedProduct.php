<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysProductType
 */
class SysOrderedProduct extends Model
{
    protected $table = 'sys_ordered_product';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'order_id',
        'unit',
        'size'
    ];

    protected $guarded = [];


}
