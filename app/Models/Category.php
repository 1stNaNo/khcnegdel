<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 */
class Category extends Model
{
    protected $table = 'category';

    protected $primaryKey = 'ca_id';

	public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'title_sid',
        'show_menu',
        'active_flag',
        'insert_user',
        'insert_date',
        'update_user',
        'update_date'
    ];

    protected $guarded = [];


    public function scopePopular($query)
    {
        return $query->where('parent_id', '>', 10);
    }

    public function scopeParentId($query){
        return $query->whereShow_menu(1)->whereActive_flag(1);
    }

}
