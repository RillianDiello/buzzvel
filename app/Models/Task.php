<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'user_id', 'task_status_id'];

    const DONE = 1;
    const PROGRESS = 2;
    const WAITING = 3;
    const DELETED = 4;

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
