<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Category
 */
class Vw_title extends Model
{

    protected $table = "vw_title";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query){
        $query->from('vw_title');
    }
}
