<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_unit extends Model
{

    protected $table = "vw_unit";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query, $pid){
      $query->whereProduct_id($pid);
    }

}
