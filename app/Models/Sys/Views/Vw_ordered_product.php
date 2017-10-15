<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_ordered_product extends Model
{

    protected $table = "vw_ordered_product";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeByClient($query, $client_id){
      $query->where('client_id', $client_id);
    }

}
