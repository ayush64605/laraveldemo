<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\Project;
use Illuminate\Http\Request;

class EmployeeProjectController extends Controller
{
    public function show($id)
    {
        $employee = Employee::with('projects')->findOrFail($id);
        return view('employee_project.show', compact('employee'));
    }

    public function add($employee)
    {
        $projects = Project::all();
        return view('employee_project.add', compact('employee', 'projects'));
    }

    public function save(Request $request, $employee)
    {
        $request->validate([
            'project' => 'required',
        ]);

        $exists = EmployeeProject::where('employee_id', $employee)->where('project_id', $request->project)->first();
        if ($exists) {
            return redirect()->back()->with('error', 'Project Already Assigned To This Employee');
        }

        $employeeproject = new EmployeeProject();
        $employeeproject->project_id = $request->project;
        $employeeproject->employee_id = $employee;
        $employeeproject->save();
        return redirect()->route('employee.assignedprojects', ['employee' => $employee])->with('success', 'Project Assign Successfully!');
    }

    public function assigndelete($employee, $project)
    {
        $employeeproject = EmployeeProject::where('employee_id', $employee)->where('project_id', $project)->first();
        $employeeproject->delete();
        return redirect()->route('employee.assignedprojects', ['employee' => $employee])->with('success', 'Assignment deleted successfully!');

    }
}
