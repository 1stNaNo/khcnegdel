<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SysClient
 */
class SysClient extends Model
{
    protected $table = 'sys_clients';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'province',
        'district',
        'phone',
        'is_main'
    ];

    protected $guarded = [];


}
