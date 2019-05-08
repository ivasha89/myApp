<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    public $timestamps = false;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'right', 'id',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function slbs() {

        return $this->hasMany(Slb::class);
    }

    public function brah()
    {
        return $this->hasOne(Brah::class);
    }

    public function projects()
    {

        return $this->hasMany(Project::class);
    }
}