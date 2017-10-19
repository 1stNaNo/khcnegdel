<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcPurchaser
 */
class KhcCostTemplate extends Model
{
    protected $table = 'khc_cost_template';

    protected $primaryKey = 'cost_template_id';

	public $timestamps = false;

    protected $fillable = [
    ];

    protected $guarded = [];


}
