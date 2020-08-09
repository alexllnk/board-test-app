<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function path()
    {
        return '/projects/' . $this->id;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($attr)
    {
        return $this->tasks()->create($attr);
    }

    public function addTasks($tasks)
    {
        return $this->tasks()->createMany($tasks);
    }
}
