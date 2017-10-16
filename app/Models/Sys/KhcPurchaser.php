<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcPurchaser
 */
class KhcPurchaser extends Model
{
    protected $table = 'khc_purchaser';

    protected $primaryKey = 'purchaser_id';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'city_id',
        'country_id',
        'district_id',
        'phone',
        'description',
        'address',
        'type',
        'code'
    ];

    protected $guarded = [];


}
