<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcWarehouse
 */
class VwKhcCostTemplate extends Model
{
    protected $table = 'vw_khc_costtemplate';

    protected $primaryKey = 'cost_template_id';

	public $timestamps = false;

    protected $fillable = [
    ];

    protected $guarded = [];


}
