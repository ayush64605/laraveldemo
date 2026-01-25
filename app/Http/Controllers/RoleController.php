<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function show()
    {
        $roles = Role::all();
        return view('role.show', compact('roles'));
    }
    public function add(Role $role = null)
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0];
        });

        return view('role.add', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    public function save(Request $request, Role $role = null)
    {
        $roleId = $role ? $role->id : null;

        $request->validate([
            'name' => 'required|unique:roles,name,' . $roleId,
            'permissions' => 'array',
        ]);

        DB::transaction(function () use ($request, $role) {

            if (!$role) {
                $role = Role::create(['name' => $request->name]);
            } else {
                $role->update(['name' => $request->name]);
            }

            if ($request->permissions) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
        });

        return redirect()->route('role.show', $role ? $role->id : null)
            ->with('success', $role ? 'Role updated successfully' : 'Role created successfully');
    }

    public function delete(Role $role)
    {
        DB::transaction(function () use ($role) {
            $role->permissions()->detach();

            $role->users()->each(function ($user) use ($role) {
                $user->removeRole($role->name);
            });

            $role->delete();
        });

        return redirect()->back()->with('success', 'Role deleted successfully');
    }
}
