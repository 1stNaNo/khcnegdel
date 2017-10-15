<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
use Session;
/**
 * Class Category
 */
class Vw_poll extends Model
{

    protected $table = "vw_poll";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query){
        $query->from('vw_poll')->whereLang(\Session::get("lang"))->orderBy("insert_date", "desc");
    }
}
