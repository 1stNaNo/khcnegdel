<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcWarehouse
 */
class VwKhcSupplier extends Model
{
    protected $table = 'vw_khc_supplier';

    protected $primaryKey = 'supplier_id';

	public $timestamps = false;

    protected $fillable = [
    ];

    protected $guarded = [];


}
