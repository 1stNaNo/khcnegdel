<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcUnit
 */
class KhcCost extends Model
{
    protected $table = 'khc_cost';

    protected $primaryKey = "cost_id";

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];


}
