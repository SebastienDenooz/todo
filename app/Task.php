<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function getAll()
    {
        return $this->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
    }
}
