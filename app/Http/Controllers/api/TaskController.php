<?php

namespace App\Http\Controllers\api;

use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function show(Request $request, $project)
    {
        $tasks = Task::with('comments')->where("project_id", $project)->get();

        return response()->json(['tasks' => $tasks]);
    }

    public function save(Request $request)
    {
        $request->validate([
            'task' => 'required',
        ]);
        try {

            $task = new Task();
            $task->project_id = $request->project_id;
            $task->task = $request->task;
            $task->save();

            $task->tags()->sync($request->tags ?? []);

            return response()->json([
                'message' => 'Task added successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while adding the task.',
            ], 500);
        }
    }

    public function delete(Task $task)
    {
        $task->delete();
        $task->comments()->delete();
        return response()->json([
            'message' => 'Task Deleted Successfully.'
        ], 200);
    }
}
