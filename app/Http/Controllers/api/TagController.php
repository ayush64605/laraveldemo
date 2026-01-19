<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'message' => 'Tag Added Successfully'
        ], 200);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
        return response()->json([
            'message' => 'Tag Deleted Successfully'
        ], 200);
    }
}
