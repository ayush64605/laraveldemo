<?php

namespace App\Http\Controllers;

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
                'status' => 'Active',
                'client' => 'client 1',
                'email' => 'client1@gmail.com',
                'started_at' => '25-10-2025',
                'completed_at' => '1-1-2026',
                'image' => 'product1.jpg',
            ],
            [
                'id' => 2,
                'name' => 'App Design',
                'status' => 'Complete',
                'client' => 'client 2',
                'email' => 'client3@gmail.com',
                'started_at' => '25-10-2025',
                'completed_at' => '1-1-2026',
                'image' => 'product2.jpeg',
            ]
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

    public function projectadd()
    {
        $projects = $this->getProjects();
        return view("projectform", compact('projects'));
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
            unset($projects[$index]);
            session(['projects' => array_values($projects)]);
        }

        return redirect()->route('index');
    }

    public function saveProject(Request $request)
    {
        $projects = session('projects', []);
    
        $projectData = [
            'id' => (int) $request->id,
            'name' => $request->name,
            'status' => $request->status,
            'client' => $request->client,
            'email' => $request->email,
            'started_at' => $request->start_date,
            'completed_at' => $request->complete_date,
            'image' => 'product1.jpg',
        ];
    
        $index = collect($projects)->search(function ($item) use ($request) {
            return $item['id'] == (int) $request->id;
        });
    
        if ($index !== false) {
            $projects[$index] = $projectData;
        } else {
            $projects[] = $projectData;
        }
    
        session(['projects' => $projects]);
    
        return redirect()->route('index');
    }


}
