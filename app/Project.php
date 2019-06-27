<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'title', 'description', 'expire_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($task)
    {
        $this->tasks()->create($task);
    }

    public function finished()
    {
        $diff = (new \DateTime())->getTimestamp() - (new \DateTime($this->expire_at))->getTimestamp();
        if($diff >= 0)
            return $this;
        else
            return false;
    }

    public function actual()
    {
        $diff = (new \DateTime())->getTimestamp() - (new \DateTime($this->expire_at))->getTimestamp();
        if($diff < 0)
            return $this;
        else
            return false;
    }
}
