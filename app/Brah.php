<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brah extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'sname', 'tel', 'city', 'user_id'
    ];
}
