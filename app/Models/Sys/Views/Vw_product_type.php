<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_product_type extends Model
{

    protected $table = "vw_product_type";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query, $id){
      $query->where('id', '<>', $id);
    }

}
