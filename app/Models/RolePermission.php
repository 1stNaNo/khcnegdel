<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RolePermission
 */
class RolePermission extends Model
{
    protected $table = 'role_permission';

    protected $primaryKey = 'rp_id';

	public $timestamps = true;

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    protected $guarded = [];

        
}