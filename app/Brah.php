<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brah extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'sname', 'tel', 'city', 'user_id'
    ];
}
