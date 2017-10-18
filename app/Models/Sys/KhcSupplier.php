<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcPurchaser
 */
class KhcSupplier extends Model
{
    protected $table = 'khc_supplier';

    protected $primaryKey = 'supplier_id';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'city_id',
        'country_id',
        'district_id',
        'phone',
        'description',
        'address',
        'code'
    ];

    protected $guarded = [];


}
