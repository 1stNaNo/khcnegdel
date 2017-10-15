<?php

namespace App\Models\Sys\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_order extends Model
{

    protected $table = "vw_order";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeByClient($query, $client_id){
      $query->where('client_id', $client_id)->orderBy('insert_date', 'desc');
    }

}
