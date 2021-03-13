<?php


namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController
{
    /**
     * @param Request $request
     * @return Task
     */
    public function create(Request $request): Task
    {
        $task = new Task();
        $task->title = $request->title;
        $task->body = $request->body;

        $task->save();
        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
    }

    public function read()
    {
        return view('todoList', ['tasks' => Task::all()]);
    }
}
