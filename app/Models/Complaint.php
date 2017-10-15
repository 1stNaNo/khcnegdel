<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Complaint
 */
class Complaint extends Model
{
    protected $table = 'complaints';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'content',
        'type',
        'kind',
        'insert_date',
        'update_date',
        'decision'
    ];

    protected $guarded = [];

}