<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcEmployer
 */
class KhcEmployer extends Model
{
    protected $table = 'khc_employer';

    protected $primaryKey = 'emp_id';

	public $timestamps = false;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'wh_id',
        'phone',
        'city_id',
        'address',
        'district_id',
        'country_id'
    ];

    protected $guarded = [];


}
