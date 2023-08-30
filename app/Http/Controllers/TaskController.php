<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Database\Factories\TaskFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{

    public function __construct(public readonly TaskService $taskService)
    {
    }

    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $rules = [
          'title' => 'required|min:3|max:50',
          'description' => 'sometimes|required',
          'attachment' => 'nullable',
          'user_id' => 'exists:users,id',
        ];
        $feedback = [
          'required' => 'Field :attribute is obligated',
          'title.min' => 'Min size is 3 chars',
          'title.max' => 'Max size is 50 chars',
          'user_id.exists' => 'The user associated does not exists',
        ];
        $request->validate($rules, $feedback);

        $task = $this->taskService->createNewTask($request->all());

        return response()->json($task, 201);
    }

    public function show($id)
    {

        $task = Task::with([
          'user' => function ($query) {
              $query->select('id', 'name', 'email');
          },
          'taskStatus' => function ($query) {
              $query->select('id', 'name');
          }
        ])->findOrFail($id);


        return response()->json($task);
    }


    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);


        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $rules = [
          'title' => 'sometimes|required|min:3|max:50',
          'description' => 'sometimes|required',
          'attachment' => 'nullable',
          'user_id' => 'sometimes|exists:users,id',
          'task_status_id' => 'sometimes|exists:task_statuses,id',
        ];
        $feedback = [
          'required' => 'Field :attribute is obligated',
          'title.min' => 'Min size is 3 chars',
          'title.max' => 'Max size is 50 chars',
          'user_id.exists' => 'The user associated does not exists',
          'task_status_id.exists' => 'The status associated with the task does not exist',
        ];
        $request->validate($rules, $feedback);
        $updatedTask = $this->taskService->updateTask($task, $request->all());

        return response()->json($updatedTask);

    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $deleted = $this->taskService->deleteTask($task);
        return response()->json($deleted, 204);
    }
}
