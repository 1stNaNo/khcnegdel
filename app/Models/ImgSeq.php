<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImgSeq
 */
class ImgSeq extends Model
{
    protected $table = 'img_seq';

    public $timestamps = false;

    protected $fillable = [
        'value'
    ];

    protected $guarded = [];

        
}