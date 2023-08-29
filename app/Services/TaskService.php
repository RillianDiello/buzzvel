<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskStatus;
use Exception;
use PHPUnit\Event\Code\Throwable;

class TaskService
{

    public function createNewTask(array $data)
    {

        $newTask = new Task();
        $newTask->title = $data['title'];
        $newTask->description = $data['description'];
        $newTask->attachment = $data['attachment'];
        $newTask->user_id = $data['user_id'];
        $newTask->task_status_id = Task::WAITTING;

        return !$newTask->save() ? throw new Exception('Error on create Task') : $newTask;
    }

    public function updateTask(Task $task, array $data)
    {
        $newStatus = $data['task_status_id'] ?? null;

        if (array_key_exists('task_status_id', $data)) {
            if ($newStatus === Task::DONE) {
                $task->completed_at = now();
            } else {
                $task->completed_at = null;
            }
        }

        $task->fill($data);
        $task->save();

        return $task;
    }

    public function deleteTask(Task $task)
    {
        $task->task_status_id = Task::DELETED;
        $task->deleted_at = now();
        $task->save();
        return $task;
    }
}