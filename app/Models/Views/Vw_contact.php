<?php

namespace App\Models\Views;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Category
 */
class Vw_contact extends Model
{

    protected $table = "vw_contact";

    protected $guarded = [];

    protected $fillable = [];

    public function scopeFromView($query){
        $query->from('vw_contact');
    }
}
