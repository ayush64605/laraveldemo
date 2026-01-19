<?php

namespace App\Http\Controllers\api;

use App\Models\Project;
use App\Models\Projectuser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectuserController extends Controller
{
    public function save(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $exist = Projectuser::where('project_id', $project->id)->first();
        if ($exist) {
            return response()->json(['message' => 'Project user already exists for this project'], 401);
        }

        $projectuser = new Projectuser();
        $projectuser->name = $request->name;
        $projectuser->email = $request->email;
        $projectuser->project_id = $project->id;
        $projectuser->save();


        return response()->json(['message' => 'Project user added successfully'], 200);
    }

    public function delete($project)
    {
        $projectuser = Projectuser::where('project_id', $project)->first();
        $projectuser->delete();
        return response()->json(['message' => 'Project User Deleted Successfully.'], 200);
    }
}
