<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Vw_ufile extends Model
{

    private static $vw = "vw_ufiles";

    protected $table = "vw_ufiles";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query){
        $query->from(self::$vw)->whereLang(\Session::get("lang"));
    }

    public function scopeEqualListByIdLang($query, $lang, $id){
      $query->from(self::$vw)->whereLang($lang)->whereId($id);
    }

    public function scopeMainSlide($query){
        $query->from(self::$vw)->whereLang(\Session::get("lang"))->whereSlide(1)->whereActive_flag(1)->groupBy("id");
    }

    public function scopeLatestNews($query){
        $query->from(self::$vw)->whereLang(\Session::get("lang"))->whereActive_flag(1)->orderBy("insert_date","DESC")->groupBy("id");
    }

    public function scopeByCategory($query, $cat_id, $paginate){
      $query->from(self::$vw)->whereLang(\Session::get("lang"))->whereCat_id($cat_id)->whereActive_flag(1)->paginate($paginate);
    }

    public function scopeByCategoryList($query, $cat_id){
      $query->from(self::$vw)->whereLang(\Session::get("lang"))->whereCat_id($cat_id);
    }

    public function scopeById($query, $id){
      $query->from(self::$vw)->whereLang(\Session::get("lang"))->whereId($id);
    }

    public function scopeByIdAndLang($query, $id, $lang){
      $query->from(self::$vw)->whereId($id)->whereLang($lang);
    }

    public function scopeSearch($query, $keyword){
      if($keyword == ""){
        $keyword = "!@#$@$@%@%@^#^#^QWEQEQWEQEWQE";
      }
      $query->from(self::$vw)->whereLang(\Session::get("lang"))->where('title', 'like', '%' . $keyword . '%')->groupBy("id");
    }
}
