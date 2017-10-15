<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_category extends Model
{

    protected $table = "vw_category";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query){
        $query->from('vw_category')->whereLang(\Session::get("lang"));
    }

    public function scopeFromViewShowed($query){
        $query->from('vw_category')->whereLang(\Session::get("lang"))->whereShow_menu(1);
    }

    public function scopeEqualListById($query, $cat_id){
      $query->from('vw_category')->whereLang(\Session::get("lang"))->whereCa_id($cat_id);
    }

    public function scopeEqualListByIdLang($query, $lang, $cat_id){
      $query->from('vw_category')->whereLang($lang)->whereCa_id($cat_id);
    }

    public function scopeChildListByParentId($query, $cat_id){
      $query->from('vw_category')->whereLang(\Session::get("lang"))->whereParent_id($cat_id);
    }
}
