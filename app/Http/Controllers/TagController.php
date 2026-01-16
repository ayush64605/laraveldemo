<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view("index", compact('tags'));
    }
    public function show()
    {
        $tags = Tag::with('projects')->get();
        return view("tag.show", compact('tags'));
    }

    public function add()
    {
        return view("tag.add");
    }


    public function delete(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tag.show')->with('success', 'tag Deleted Successfilly.');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        return redirect()->route('tag.show')->with('success', 'Tag Added Successfully');
    }
}
