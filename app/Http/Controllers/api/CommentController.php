<?php

namespace App\Http\Controllers\api;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function save(Request $request)
    {
        try {
            $request->validate([
                'comment' => 'required'

            ]);

            if ($request->task) {
                $task = Task::findOrFail($request->task);
                $task->comments()->create(['body' => $request->comment, 'employee_id' => 2]);
            }

            if ($request->project) {
                $project = Project::findOrFail($request->project);
                $project->comments()->create(['body' => $request->comment, 'employee_id' => 2]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while adding the comment.'], 500);
        }

        return response()->json(['message' => 'Comment Added Successfully'], 200);
    }
}
