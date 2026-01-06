<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private function getProjects()
    {
        return [
            [
                'id' => 101,
                'name' => 'Website Redesign',
                'status' => 'active',
                'client' => [
                    'id' => 1,
                    'name' => 'Acme Corp',
                    'email' => 'contact@acme.com',
                    'phone' => null,
                ],
                'manager' => [
                    'id' => 11,
                    'name' => 'Amit Sharma',
                    'email' => 'amit.sharma@example.com',
                ],
                'budget' => 150000,
                'currency' => 'INR',
                'tags' => ['ui', 'ux', 'frontend'],
                'started_at' => '2025-01-05',
                'completed_at' => null,
                'tasks' => [
                    [
                        'id' => 1001,
                        'title' => 'Create wireframes',
                        'status' => 'completed',
                        'priority' => 'high',
                        'assignee' => [
                            'id' => 21,
                            'name' => 'Neha Patel',
                            'email' => 'neha.patel@example.com',
                        ],
                        'due_date' => '2025-01-15',
                        'completed_at' => '2025-01-14',
                        'comments' => [
                            [
                                'id' => 1,
                                'message' => 'Wireframes approved by client',
                                'created_at' => '2025-01-14 10:30',
                            ],
                        ],
                    ],
                    [
                        'id' => 1002,
                        'title' => 'UI Design',
                        'status' => 'in_progress',
                        'priority' => 'medium',
                        'assignee' => null,
                        'due_date' => '2025-01-25',
                        'completed_at' => null,
                        'comments' => [],
                    ],
                ],
            ],
            [
                'id' => 102,
                'name' => 'Mobile App Development',
                'status' => 'on_hold',
                'client' => [
                    'id' => 2,
                    'name' => 'TechNova',
                    'email' => null,
                    'phone' => '+14155551234',
                ],
                'manager' => null,
                'budget' => null,
                'currency' => 'USD',
                'tags' => [],
                'started_at' => '2025-02-01',
                'completed_at' => null,
                'tasks' => [
                    [
                        'id' => 2001,
                        'title' => 'API Architecture',
                        'status' => 'pending',
                        'priority' => 'high',
                        'assignee' => [
                            'id' => 31,
                            'name' => 'Rahul Verma',
                            'email' => 'rahul.verma@example.com',
                        ],
                        'due_date' => null,
                        'completed_at' => null,
                        'comments' => null,
                    ],
                ],
            ],
        ];
    }
    public function index()
    {
        $projects = $this->getProjects();
        return view("index", compact('projects'));
    }

    public function projectdetails($id)
    {
        $projects = $this->getProjects();
        $project = collect($projects)->firstWhere('id', (int) $id);
        return view("projectdetails", compact('project'));
    }

}
