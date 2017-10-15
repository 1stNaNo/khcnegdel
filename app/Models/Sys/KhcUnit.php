<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KhcUnit
 */
class KhcUnit extends Model
{
    protected $table = 'khc_unit';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type'
    ];

    protected $guarded = [];


}
