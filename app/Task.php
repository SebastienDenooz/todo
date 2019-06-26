<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
