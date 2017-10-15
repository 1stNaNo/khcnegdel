<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcWarehouse
 */
class VwKhcWarehouse extends Model
{
    protected $table = 'vw_khc_warehouse';

    protected $primaryKey = 'wh_id';

	public $timestamps = false;

    protected $fillable = [
    ];

    protected $guarded = [];


}
