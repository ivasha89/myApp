<?php

namespace БСШСА;

use Illuminate\Database\Eloquent\Model;

class Brah extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'sname', 'tel', 'city', 'ids'
    ];
}
