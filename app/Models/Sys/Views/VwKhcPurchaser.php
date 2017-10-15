<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcWarehouse
 */
class VwKhcPurchaser extends Model
{
    protected $table = 'vw_khc_purchaser';

    protected $primaryKey = 'purchaser_id';

	public $timestamps = false;

    protected $fillable = [
    ];

    protected $guarded = [];


}
