<?php

namespace App\Http\Controllers\api;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Models\EmployeeProject;
use Illuminate\Http\Request;


class EmployeeProjectController extends Controller
{
    public function show($id)
    {
        $employee = Employee::with('projects')->findOrFail($id);
        return response()->json($employee);
    }

    public function save(Request $request, $employee)
    {
        $request->validate([
            'project' => 'required',
        ]);

        $exists = EmployeeProject::where('employee_id', $employee)->where('project_id', $request->project)->first();
        if ($exists) {
            return response()->json([
                'message' => 'Project Already Assigned To This Employee'
            ], 401);
        }

        $employeeproject = new EmployeeProject();
        $employeeproject->project_id = $request->project;
        $employeeproject->employee_id = $employee;
        $employeeproject->save();
        return response()->json([
            'message' => 'Project Assign Successfully!'
        ], 200);
    }

    public function delete($employee, $project)
    {
        $employeeproject = EmployeeProject::where('employee_id', $employee)->where('project_id', $project)->first();
        $employeeproject->delete();
        return response()->json([
            'message' => 'Assignment deleted successfully!'
        ], 200);
    }

}
