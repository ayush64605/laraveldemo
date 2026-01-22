<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Project;
use App\Models\Projectcategory;
use App\Models\Tag;
use Storage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(Request $request)
    {
        $projects = Project::all();

        if ($request->filled('tag_id')) {
            $projects = Tag::where('id', $request->tag_id)->first()->projects;
        }

        return view('project.show', compact('projects'));
    }


    public function add()
    {
        $last_project = Project::orderBy('id', 'desc')->first();
        if (!$last_project) {
            $last_project = new Project();
            $last_project->id = 0;
        }
        $projectcategories = Projectcategory::orderBy('id', 'desc')->get();
        return view("project.add", compact('last_project', 'projectcategories'));
    }

    public function assignemployee($project)
    {
        $projects = Project::with('employees')->findOrFail($project);
        return view("project.employee", compact('projects'));
    }

    public function details(Project $project)
    {
        return view("project.details", compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $projectcategories = Projectcategory::orderBy('id', 'desc')->get();
        return view("project.add", compact('project', 'projectcategories'));
    }

    public function delete(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image->url);
        }
        $project->comments()->delete();
        $project->delete();
        return redirect()->route('project.show')->with('success', 'Project Deleted Successfilly.');
    }

    public function save(StorePostRequest $request)
    {
        $validated = $request->validated();

        $index = Project::find($request->id);

        if ($index) {
            $project = $index;
        } else {
            $project = new Project();
        }

        $projetcexist = Project::where('client_email', $request->emmail)->first();
        if (isset($index) == false) {
            if ($projetcexist) {
                return redirect()->back()->with('error', 'Email is already exist');
            }
        }

        if ($index) {
            if ($request->hasFile('image')) {
                if ($project->image) {
                    Storage::disk('public')->delete($project->image->url);
                }
                $path = $request->file('image')->store('projectimage', 'public');
                $project->image()->updateOrCreate(
                    ['imageable_id' => $project->id, 'imageable_type' => Project::class],
                    ['url' => $path]
                );
            }
        }

        if ($request->project_key) {
            if ($request->project_key == $request->c_project_key) {
                $project_key = $request->project_key;
            } else {
                return redirect()->back()->with('error', 'Project key and confrim project key are not matched.');
            }
        } else {
            $project_key = $project->project_key;
        }

        $project->name = $request->name;
        $project->project_category = $request->project_category;
        $project->project_code = $request->project_code;
        $project->project_key = $project_key;
        $project->status = $request->status ?? 'Active';
        $project->priority = $request->priority;
        $project->progress = $request->progress ?? 0;
        $project->budget = $request->budget;
        $project->project_url = $request->project_url;
        $project->project_type = $request->project_type;
        $project->description = $request->description;
        $project->started_at = $request->start_date;
        $project->completed_at = $request->complete_date;
        $project->deadline_time = $request->deadline_time;
        $project->technologies = $request->technologies ?? [];
        $project->is_featured = $request->boolean('is_featured');
        $project->client_name = $request->client_name;
        $project->client_email = $request->client_email;
        $project->client_phone = $request->client_phone;
        $project->client_company = $request->client_company;
        $project->client_pan = $request->client_pan;
        $project->client_website = $request->client_website;
        $project->client_address = $request->client_address;
        $project->save();

        $project->tags()->sync($request->tags ?? []);


        if (!$index) {
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('projectimage', 'public');
                $project->image()->create(['url' => $path]);
            }
        }

        if ($index) {
            $msg = 'Project Updated Successfully';
        } else {
            $msg = 'Project Added Successfully';
        }

        return redirect()->route('project.show')->with('success', $msg);
    }

}
