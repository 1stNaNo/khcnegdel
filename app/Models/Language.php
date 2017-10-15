<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 */
class Language extends Model
{
    protected $table = 'language';

    protected $primaryKey = 'lang_id';

	public $timestamps = true;

    protected $fillable = [
        'lang_name',
        'lang_shortname',
        'lang_key'
    ];

    protected $guarded = [];

        
}