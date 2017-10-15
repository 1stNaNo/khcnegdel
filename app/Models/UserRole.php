<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole
 */
class UserRole extends Model
{
    protected $table = 'user_role';

    protected $primaryKey = 'user_role_id';

	public $timestamps = true;

    protected $fillable = [
        'role_id',
        'user_id'
    ];

    protected $guarded = [];

        
}