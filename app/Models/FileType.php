<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FileType
 */
class FileType extends Model
{
    protected $table = 'file_type';

    protected $primaryKey = 'ft_id';

	public $timestamps = false;

    protected $fillable = [
        'title_sid',
        'active_flag',
        'icon'
    ];

    protected $guarded = [];

        
}