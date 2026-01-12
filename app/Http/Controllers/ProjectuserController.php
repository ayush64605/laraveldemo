<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Projectuser;
use Illuminate\Http\Request;

class ProjectuserController extends Controller
{
    public function add(Project $project)
    {
        return view("projectadduserform", compact("project"));
    }

    public function save(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $projectuser = new Projectuser();
        $projectuser->name = $request->name;
        $projectuser->email = $request->email;
        $projectuser->project_id = $project->id;
        $projectuser->save();


        return redirect()->route('project.show')->with('success', 'Project user added successfully');
    }

    public function delete($project)
    {
        $projectuser = Projectuser::where('project_id', $project)->first();
        $projectuser->delete();
        return redirect()->route('project.show')->with('success', 'Project User Deleted Successfilly.');
    }
}
