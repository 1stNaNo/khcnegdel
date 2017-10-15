<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcWarehouse
 */
class KhcWarehouse extends Model
{
    protected $table = 'khc_warehouse';

    protected $primaryKey = 'wh_id';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'city_id',
        'country_id',
        'district_id',
        'phone',
        'is_centre'
    ];

    protected $guarded = [];


}
