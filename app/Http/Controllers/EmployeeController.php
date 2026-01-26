<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\Project;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
    public function show()
    {
        if (!checkPermission(['employee.view'])) {
            return redirect()->route('dashboard');
        }
        $employees = Employee::all();
        return view("employee.show", compact("employees"));
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

        if ($index) {
            $msg = 'Employee Updated Successfully';
        } else {
            $msg = 'Employee Added Successfully!';
        }
        return redirect()->route('employee.show')->with('success', $msg);
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.show')->with('success', 'Employee Delete Successfully');
    }

    public function login()
    {
        return view('employee_dashboard.login');
    }

    public function employeelogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $employee = Employee::where('email', $request->email)->first();
        if ($employee) {
            session()->put('employeedata', $employee);
            return redirect()->route('employee.index');
        } else {
            return redirect()->back()->with('error', 'Employee Does Not Exist.');
        }
    }

    public function index()
    {
        $employee = Session::get('employeedata');
        $projects = EmployeeProject::with('projects')->where('employee_id', $employee->id)->get();
        return view('employee_dashboard.index', compact('projects'));
    }

    public function logout()
    {
        Session::forget('employeedata');
        return redirect()->route('employee.login');
    }
}
