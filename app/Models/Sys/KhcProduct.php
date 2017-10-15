<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcProduct
 */
class KhcProduct extends Model
{
    protected $table = 'khc_product';

    protected $primaryKey = 'product_id';

	public $timestamps = false;

    protected $fillable = [
        'measure_id',
        'type',
        'code',
        'f_code'
    ];

    protected $guarded = [];


}
