<?php

namespace App\Http\Controllers;

use App\Models\Projectcategory;
use Illuminate\Http\Request;

class ProjectcategoryController extends Controller
{
    public function index()
    {
        $projectcategories = Projectcategory::all();
        return view("index", compact('projectcategories'));
    }
    public function show()
    {

        $projectcategories = Projectcategory::all();
        return view("projectcategory", compact('projectcategories'));
    }

    public function add()
    {
        $last_projectcategory = Projectcategory::orderBy('id', 'desc')->first();
        return view("projectcategoryform", compact('last_projectcategory'));
    }


    public function update(Request $request, Projectcategory $projectcategory)
    {
        return view("projectcategoryform", compact('projectcategory'));
    }

    public function delete(Projectcategory $projectcategory)
    {
        $projectcategory->delete();
        return redirect()->route('projectcategory.show')->with('success', 'Projectcategory Deleted Successfilly.');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $index = Projectcategory::find($request->id);

        if ($index) {
            $projectcategory = Projectcategory::find($request->id);
        } else {
            $projectcategory = new Projectcategory();
        }
        
        $projectcategory->name = $request->name;
        $projectcategory->save();


        if ($index !== false) {
            $msg = 'Project category Updated Successfully';
        } else {
            $msg = 'Project category Added Successfully';
        }

        return redirect()->route('projectcategory.show')->with('success', $msg);
    }
}
