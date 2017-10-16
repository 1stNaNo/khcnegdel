<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcProduct
 */
class KhcProduct extends Model
{
    protected $table = 'khc_product';

    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'name',
        'type',
        'code',
        'bar_code',
        'suplier'
    ];

    protected $guarded = [];


}
