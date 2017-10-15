<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_weblinks extends Model
{

    protected $table = "vw_weblinks";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query){
        $query->from('vw_weblinks')->whereLang(\Session::get("lang"));
    }

    public function scopeFromByCatId($query, $ca_id){
        $query->whereCategory_id($ca_id)->whereLang(\Session::get("lang"));
    }
}
