<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $users = User::whereNot("id", Auth::user()->id)->get();
        return view('user.show', compact('users'));
    }

    public function update(User $user)
    {
        return view('user.add', compact('user'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image->url);
            }

            $path = $request->file('image')->store('users', 'public');
            $user->image()->updateOrCreate(
                ['imageable_id' => $user->id, 'imageable_type' => User::class],
                ['url' => $path]
            );
        }

        $user->save();

        return redirect()->route('user.show')->with('success', 'User updated successfully!');
    }

    public function delete(User $user)
    {
        $user = User::findOrFail($user->id);
        if ($user->image) {
            Storage::disk('public')->delete($user->image->url);
            $user->image->delete();
        }
        $user->delete();
        return redirect()->route('user.show')->with('success', 'User Delete Successfully');
    }
}
