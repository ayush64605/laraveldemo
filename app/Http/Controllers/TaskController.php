<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Request $request, $project)
    {
        $query = Task::with('comments')->where("project_id", $project);

        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag_id);
            });
        }

        $tasks = $query->get();

        return view("task.show", compact("tasks", 'project'));
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

        $task->tags()->sync($request->tags ?? []);

        return redirect()->route('project.task.show', ['project' => $request->project_id])->with('success', 'Task added successfully.');
    }

    public function delete(Task $task)
    {
        $task->delete();
        $task->comments()->delete();
        return redirect()->back()->with('success', 'Project User Deleted Successfilly.');
    }
}
