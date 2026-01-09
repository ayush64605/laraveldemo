<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Project;
use Storage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private function getProjects()
    {
        $project = [
            [
                'id' => 1,
                'name' => 'Web Design',
                'project_code' => 'cbt-001',
                'project_key' => '55962',
                'status' => 'Active',
                'is_featured' => true,
                'priority' => 'High',
                'progress' => 75,
                'budget' => 150000,
                'project_url' => 'https://webdesign.example.com',
                'started_at' => '2025-10-25',
                'completed_at' => '2026-01-01',
                'deadline_time' => '18:00',
                'project_type' => 'Client',
                'technologies' => ['Laravel', 'React'],
                'description' => 'Corporate website design with admin panel.',
                'image' => 'projectimage/product1.jpg',
                'client_name' => 'Client 1',
                'client_email' => 'client1@gmail.com',
                'client_pan' => 'AAAPA1234A',
                'client_phone' => '9876543210',
                'client_company' => 'Client One Pvt Ltd',
                'client_website' => 'https://client1.com',
                'client_address' => 'Ahmedabad, Gujarat, India',
            ],
            [
                'id' => 2,
                'name' => 'App Design',
                'project_code' => 'cbt-002',
                'project_key' => '52931',
                'status' => 'Completed',
                'is_featured' => false,
                'priority' => 'Medium',
                'progress' => 100,
                'budget' => 250000,
                'project_url' => 'https://appdesign.example.com',
                'started_at' => '2025-10-25',
                'completed_at' => '2026-01-01',
                'deadline_time' => '20:30',
                'project_type' => 'Internal',
                'technologies' => ['Vue', 'Node'],
                'description' => 'Mobile application UI/UX design.',
                'image' => 'projectimage/product2.jpeg',
                'client_name' => 'Client 2',
                'client_pan' => 'AAAPA1324A',
                'client_email' => 'client2@gmail.com',
                'client_phone' => '9123456789',
                'client_company' => 'Client Two Solutions',
                'client_website' => 'https://client2.com',
                'client_address' => 'Surat, Gujarat, India',
            ],
        ];

        session()->put('projects', $project);


        return $project;
    }

    public function index()
    {
        if (session('projects')) {
            $projects = session('projects');
        } else {
            $projects = $this->getProjects();
        }

        return view("index", compact('projects'));
    }
    public function show()
    {
        if (session('projects')) {
            $projects = session('projects');
        } else {
            $projects = $this->getProjects();
        }

        return view("projects", compact('projects'));
    }

    public function add()
    {
        return view("projectform");
    }

    public function details($id)
    {
        $projects = session('projects');

        $project = collect($projects)->firstWhere('id', (int) $id);
        return view("projectdetails", compact('project'));
    }

    public function update(Request $request, $id)
    {
        $projects = session('projects');
        $project = collect($projects)->firstWhere('id', (int) $id);
        return view("projectform", compact('project'));

    }

    public function delete($project_id)
    {
        $projects = session('projects', []);
        $index = collect($projects)->search(function ($item) use ($project_id) {
            return $item['id'] == (int) $project_id;
        });
        if ($index !== false) {
            Storage::disk('public')->delete($projects[$index]['image']);
            unset($projects[$index]);
            session(['projects' => array_values($projects)]);
        }

        return redirect()->route('project.show')->with('success', 'Project Deleted Successfilly.');
    }

    public function save(StorePostRequest $request)
    {
        $validated = $request->validated();

        $projects = session('projects', []);
        $index = collect($projects)->search(fn($item) => $item['id'] == (int) $request->id);

        $userexist = collect($projects)->search(fn($item) => $item['client_email'] == $request->client_email);
        if (isset($index) == false) {
            if ($userexist) {
                return redirect()->back()->with('error', 'Email is already exist');
            }
        }

        if ($request->hasFile('image')) {
            if ($index !== false && isset($projects[$index]['image'])) {
                Storage::disk('public')->delete($projects[$index]['image']);
            }
            $imagePath = $request->file('image')->store('projectimage', 'public');
        } else {
            $imagePath = ($index !== false) ? $projects[$index]['image'] : null;
        }

        if ($request->project_key) {
            if ($request->project_key == $request->c_project_key) {
                $project_key = $request->project_key;
            } else {
                return redirect()->back()->with('error', 'Project key and confrim project key are not matched.');
            }
        } else {
            $project_key = $projects[$index]['project_key'];
        }



        $projectData = [
            'id' => (int) $request->id,
            'name' => $request->name,
            'project_code' => $request->project_code,
            'project_key' => $project_key,
            'status' => $request->status ?? 'Active',
            'priority' => $request->priority,
            'progress' => $request->progress ?? 0,
            'budget' => $request->budget,
            'project_url' => $request->project_url,
            'project_type' => $request->project_type,
            'description' => $request->description,

            'started_at' => $request->start_date,
            'completed_at' => $request->complete_date,
            'deadline_time' => $request->deadline_time,

            'technologies' => $request->technologies ?? [],
            'is_featured' => $request->boolean('is_featured'),

            'image' => $imagePath,

            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_phone' => $request->client_phone,
            'client_company' => $request->client_company,
            'client_pan' => $request->client_pan,
            'client_website' => $request->client_website,
            'client_address' => $request->client_address,
        ];

        if ($index !== false) {
            $projects[$index] = $projectData;
            $msg = 'Project Updated Successfully';
        } else {
            $projects[] = $projectData;
            $msg = 'Project Added Successfully';
        }

        session(['projects' => $projects]);

        return redirect()->route('project.show')->with('success', $msg);
    }
}
