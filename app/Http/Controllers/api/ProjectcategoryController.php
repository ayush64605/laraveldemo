<?php

namespace App\Http\Controllers\api;

use App\Models\Projectcategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectcategoryController extends Controller
{
    public function show()
    {
        $projectcategories = Projectcategory::all();
        return response()->json($projectcategories);
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

        return response()->json(['msg' => $msg], 200);
    }

    public function delete($projectcategory)
    {
        try {
            $projectcategory = Projectcategory::findOrFail($projectcategory);
            $projectcategory->delete();
            return response()->json(["message" => "Category Deleted Successfully"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Error in deleting category"], 500);
        }
    }
}
