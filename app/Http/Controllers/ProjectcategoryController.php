<?php

namespace App\Http\Controllers;

use App\Models\Projectcategory;
use Illuminate\Http\Request;

class ProjectcategoryController extends Controller
{
    public function show()
    {
        $projectcategories = Projectcategory::with('projects')->get();
        return view("projectcategory.show", compact('projectcategories'));
    }

    public function delete(Projectcategory $projectcategory)
    {
        $projectcategory->delete();
        return redirect()->route('projectcategory.show')->with('success', 'Projectcategory Deleted Successfilly.');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // find or create
        $projectcategory = Projectcategory::find($request->id) ?? new Projectcategory();

        $projectcategory->name = $request->name;
        $projectcategory->save();

        $msg = $request->id
            ? 'Project category Updated Successfully'
            : 'Project category Added Successfully';

        return redirect()
            ->route('projectcategory.show')
            ->with('success', $msg);
    }
}
