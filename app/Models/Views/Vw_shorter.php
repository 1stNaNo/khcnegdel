<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_shorter extends Model
{

    public function scopeFromView($query){
        $query->from('vw_shorter')->whereLang(\Session::get("lang"));
    }

    public function scopeEqualListByIdLang($query, $lang, $cat_id){
      $query->from('vw_shorter')->whereLang($lang)->whereId($cat_id);
    }
}
