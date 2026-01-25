<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use DB;
use Storage;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserController extends Controller
{
    public function show()
    {
        $users = User::whereNot("id", Auth::user()->id)->get();
        return view('user.show', compact('users'));
    }

    public function add(User $user = null)
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });

        return view('user.add', compact('user', 'roles', 'permissions'));
    }

    public function save(Request $request, User $user = null)
    {
        $userId = $user ? $user->id : null;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => $user ? 'nullable|min:6|confirmed' : 'required|min:6|confirmed',
            'image' => 'nullable|image|max:2048',
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
        ]);

        DB::transaction(function () use ($request, $user) {

            if (!$user) {
                $user = new User();
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('users', 'public');
                $user->image()->updateOrCreate(
                    ['imageable_id' => $user->id, 'imageable_type' => User::class],
                    ['url' => $path]
                );
            }

            app(PermissionRegistrar::class)->forgetCachedPermissions();

            $role = Role::findOrFail($request->role_id);
            $user->syncRoles([$role->name]);

            $rolePermissions = $role->permissions->pluck('name')->toArray();
            $extraPermissions = array_diff($request->permissions ?? [], $rolePermissions);

            $user->syncPermissions(array_merge($rolePermissions, $extraPermissions));
        });

        return redirect()->route('user.show', $user->id ?? null)
            ->with('success', $user ? 'User updated successfully' : 'User created successfully');
    }

    public function delete(User $user)
    {
        DB::transaction(function () use ($user) {
            $user->roles()->detach();
            $user->permissions()->detach();

            if ($user->image) {
                Storage::disk('public')->delete($user->image->url);
                $user->image()->delete();
            }
            $user->delete();
        });

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
