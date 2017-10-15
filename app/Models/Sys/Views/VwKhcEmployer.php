<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcWarehouse
 */
class VwKhcEmployer extends Model
{
    protected $table = 'vw_khc_employer';

    protected $primaryKey = 'emp_id';

	public $timestamps = false;

    protected $fillable = [
    ];

    protected $guarded = [];


}
