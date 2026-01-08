<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Storage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private function getProjects()
    {
        // return [
        //     [
        //         'id' => 101,
        //         'name' => 'Website Redesign',
        //         'status' => 'active',
        //         'image' => 'product1.jpg',
        //         'client' => [
        //             'id' => 1,
        //             'name' => 'Acme Corp',
        //             'email' => 'contact@acme.com',
        //             'phone' => null,
        //         ],
        //         'manager' => [
        //             'id' => 11,
        //             'name' => 'Amit Sharma',
        //             'email' => 'amit.sharma@example.com',
        //         ],
        //         'budget' => 150000,
        //         'currency' => 'INR',
        //         'tags' => ['ui', 'ux', 'frontend'],
        //         'started_at' => '2025-01-05',
        //         'completed_at' => null,
        //         'tasks' => [
        //             [
        //                 'id' => 1001,
        //                 'title' => 'Create wireframes',
        //                 'status' => 'completed',
        //                 'priority' => 'high',
        //                 'assignee' => [
        //                     'id' => 21,
        //                     'name' => 'Neha Patel',
        //                     'email' => 'neha.patel@example.com',
        //                 ],
        //                 'due_date' => '2025-01-15',
        //                 'completed_at' => '2025-01-14',
        //                 'comments' => [
        //                     [
        //                         'id' => 1,
        //                         'message' => 'Wireframes approved by client',
        //                         'created_at' => '2025-01-14 10:30',
        //                     ],
        //                 ],
        //             ],
        //             [
        //                 'id' => 1002,
        //                 'title' => 'UI Design',
        //                 'status' => 'in_progress',
        //                 'priority' => 'medium',
        //                 'assignee' => null,
        //                 'due_date' => '2025-01-25',
        //                 'completed_at' => null,
        //                 'comments' => [],
        //             ],
        //         ],
        //     ],
        //     [
        //         'id' => 102,
        //         'name' => 'Mobile App Development',
        //         'status' => 'on_hold',
        //         'image' => 'product2.jpeg',
        //         'client' => [
        //             'id' => 2,
        //             'name' => 'TechNova',
        //             'email' => null,
        //             'phone' => '+14155551234',
        //         ],
        //         'manager' => null,
        //         'budget' => null,
        //         'currency' => 'USD',
        //         'tags' => [],
        //         'started_at' => '2025-02-01',
        //         'completed_at' => null,
        //         'tasks' => [
        //             [
        //                 'id' => 2001,
        //                 'title' => 'API Architecture',
        //                 'status' => 'pending',
        //                 'priority' => 'high',
        //                 'assignee' => [
        //                     'id' => 31,
        //                     'name' => 'Rahul Verma',
        //                     'email' => 'rahul.verma@example.com',
        //                 ],
        //                 'due_date' => null,
        //                 'completed_at' => null,
        //                 'comments' => null,
        //             ],
        //         ],
        //     ],
        // ];

        $project = [
            [
                'id' => 1,
                'name' => 'Web Design',
                'project_code' => 'WD-001',
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
                'project_code' => 'AD-002',
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
        $projects = session('projects');
        // $projects = $this->getProjects();
        // dd(session('projects'));

        return view("index", compact('projects'));
    }
    public function projects()
    {
        $projects = session('projects');
        // $projects = $this->getProjects();
        // dd(session('projects'));

        return view("projects", compact('projects'));
    }

    public function projectadd()
    {
        return view("projectform");
    }

    // public function projectsave(Request $request)
    // {
    //     $projects = session()->get('projects');
    //     // dd( $projects);
    //     $newproject = [
    //         'id' => $request->id,
    //         'name' => $request->name,
    //         'status' => $request->status,
    //         'client' => $request->client,
    //         'email' => $request->email,
    //         'started_at' => $request->start_date,
    //         'completed_at' => $request->complete_date,
    //         'image' => 'product1.jpg',
    //     ];

    //     $projects[] = $newproject;
    //     session()->put('projects', $projects);
    //     // dd(session('projects'));
    //     return redirect()->route('index');
    // }
    public function projectdetails($id)
    {
        // $projects = $this->getProjects();
        $projects = session('projects');

        $project = collect($projects)->firstWhere('id', (int) $id);
        return view("projectdetails", compact('project'));
    }

    public function projectupdate(Request $request, $id)
    {
        $projects = session('projects');
        $project = collect($projects)->firstWhere('id', (int) $id);
        // dd($project);
        return view("projectform", compact('project'));

    }

    // public function projectedit(Request $request, $project_id)
    // {
    //     $projects = session('projects', []);
    //     $index = collect($projects)->search(function ($item) use ($project_id) {
    //         return $item['id'] == (int) $project_id;
    //     });
    //     if ($index !== false) {
    //         $projects[$index]['name'] = $request->name;
    //         $projects[$index]['status'] = $request->status;
    //         $projects[$index]['client'] = $request->client;
    //         $projects[$index]['email'] = $request->email;
    //         $projects[$index]['started_at'] = $request->start_date;
    //         $projects[$index]['completed_at'] = $request->complete_date;
    //         session(['projects' => $projects]);
    //     }

    //     return redirect()->route('index');
    // }

    public function projectdelete($project_id)
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

    public function saveProject(StorePostRequest $request)
    {
        $validated = $request->validated();

        $projects = session('projects', []);
        $index = collect($projects)->search(fn($item) => $item['id'] == (int) $request->id);

        if ($request->hasFile('image')) {
            if ($index !== false && isset($projects[$index]['image'])) {
                Storage::disk('public')->delete($projects[$index]['image']);
            }
            $imagePath = $request->file('image')->store('projectimage', 'public');
        } else {
            $imagePath = ($index !== false) ? $projects[$index]['image'] : null;
        }

        $projectData = [
            'id' => (int) $request->id,
            'name' => $request->name,
            'project_code' => $request->project_code,
            'status' => $request->status ?? 'Completed',
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
