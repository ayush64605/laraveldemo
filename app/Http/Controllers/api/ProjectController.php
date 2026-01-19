<?php

namespace App\Http\Controllers\api;

use App\Models\Project;
use App\Models\Task;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function show()
    {
        $projects = Project::all();

        return response()->json($projects);
    }

    public function projectDetails($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        return response()->json([
            'project' => $project,
        ]);
    }

    public function task($project)
    {
        $tasks = Task::with('comments')->where("project_id", $project)->get();
        if (count($tasks) == 0) {
            return response()->json(['error' => 'Tasks not found'], 404);
        }
        return response()->json($tasks);
    }

    public function projectComments($project)
    {
        $project = Project::with('comments')->find($project);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        return response()->json($project->comments);
    }

    public function projectEmployee($project)
    {
        $project = Project::with('employees')->find($project);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        return response()->json($project->employees);
    }

}
