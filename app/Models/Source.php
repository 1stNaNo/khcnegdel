<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Source
 */
class Source extends Model
{
    protected $table = 'sources';

    protected $primaryKey = 'source_id';

	public $timestamps = false;

    protected $fillable = [
        'source',
        'lang',
        'kind',
        'code'
    ];

    protected $guarded = [];

    public function scopeByCode($query, $code, $lang){
        return $query->whereCode($code)->whereLang($lang);
    }

    public function scopeDeleteByCode($query, $code){
        return $query->whereCode($code)->delete();
    }
}
