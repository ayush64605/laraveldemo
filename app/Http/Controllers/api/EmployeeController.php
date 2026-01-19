<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
    public function show()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            'email' => 'required|email',
            'number' => 'required|regex:/^[0-9+\-\s]{7,20}$/',
        ]);

        $index = Employee::find($request->id);

        if ($index) {
            $employee = $index;
        } else {
            $employee = new Employee();
        }

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->number = $request->number;
        $employee->save();
        return response()->json([
            'message' => 'Employee Added Successfully!'
        ], 200);
    }

    public function delete($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return response()->json(['message' => 'Employee Deleted Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred or employee not found.'], 500);
        }
    }

}