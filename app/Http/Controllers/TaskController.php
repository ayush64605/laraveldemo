<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show($project)
    {
        $tasks = Task::with('comments')->where("project_id", $project)->get();
        return view("task.show", compact("tasks", 'project'));
    }

    public function add($project)
    {
        return view('task.add', compact('project'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'task' => 'required',
        ]);

        $task = new Task();
        $task->project_id = $request->project_id;
        $task->task = $request->task;
        $task->save();
        return redirect()->route('project.task.show', ['project' => $request->project_id])->with('success', 'Task added successfully.');
    }

    public function delete(Task $task)
    {
        $task->delete();
        $task->comments()->delete();
        return redirect()->back()->with('success', 'Project User Deleted Successfilly.');
    }
}
