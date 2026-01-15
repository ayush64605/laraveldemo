<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addcommenttask($task)
    {
        $project = null;
        return view("comment.add", compact("task", 'project'));
    }

    public function addcommentproject($project)
    {
        $task = null;
        return view("comment.add", compact("task", 'project'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'comment' => 'required'

        ]);

        if ($request->task) {
            $task = Task::find($request->task);
            $task->comments()->create(['body' => $request->comment, 'employee_id' => session('employeedata')->id]);
        }

        if ($request->project) {
            $project = Project::find($request->project);
            $project->comments()->create(['body' => $request->comment, 'employee_id' => session('employeedata')->id]);
        }

        return redirect()->route('employee.index')->with('success', 'Comment Added Successfully');
    }
}
