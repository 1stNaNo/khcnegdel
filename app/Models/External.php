<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class External
 */
class External extends Model
{
    protected $table = 'external';

    public $timestamps = false;

    protected $fillable = [
        'link',
        'count'
    ];

    protected $guarded = [];

        
}