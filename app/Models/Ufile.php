<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ufile
 */
class Ufile extends Model
{
    protected $table = 'ufiles';

    public $timestamps = false;

    protected $fillable = [
        'type_id',
        'name_sid',
        'number',
        'confirm_date',
        'path'
    ];

    protected $guarded = [];

        
}