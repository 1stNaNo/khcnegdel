<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Link
 */
class Link extends Model
{
    protected $table = 'links';

    public $timestamps = false;

    protected $fillable = [
        'type',
        'link'
    ];

    protected $guarded = [];

    public function scopeByType($query, $type){
      $query->whereType($type);
    }

}
