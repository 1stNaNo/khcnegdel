<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Banner
 */
class Banner extends Model
{
    protected $table = 'banner';

    protected $primaryKey = 'banner_id';

	public $timestamps = false;

    protected $fillable = [
        'name',
        'value'
    ];

    protected $guarded = [];

  public function scopeByName($query, $name){
    $query->whereName($name);
  }
}
