<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcProductUnit
 */
class KhcProductUnit extends Model
{
    protected $table = 'khc_product_unit';

    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'master_id'
    ];

    protected $guarded = [];


}
