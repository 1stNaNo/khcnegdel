<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 */
class Contact extends Model
{
    protected $table = 'contact';

    public $timestamps = false;

    protected $fillable = [
        'address',
        'lat',
        'long',
        'phone',
        'email'
    ];

    protected $guarded = [];

        
}