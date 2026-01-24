# Roles and Permission Documentation -p

https://spatie.be/docs/laravel-permission/v6/installation-laravel

## step1 : Integrate Package

  composer require spatie/laravel-permission
  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
  php artisan optimize:clear
  php artisan migrate

  This step will create following migrations

-roles

- permissions

- model_has_roles ← links users to roles

- model_has_permissions ← links users to direct permissions

- role_has_permissions ← links roles to their permissions

  



## step 2: create or use default user table 

- the table must have role_id (foreign key ) column 

 define trait "use Spatie\Permission\Traits\HasRoles" in user model 

 When you use HasRoles, Spatie handles:

The relationships to the roles and permissions tables

The pivot tables: model_has_roles, model_has_permissions

Helper methods for all role/permission operations

Permission inheritance via roles

If you forget to include use HasRoles;, your User model won’t have access to any of these methods — and you'll get errors like:

Call to undefined method App\Models\User::assignRole()

## step 4: store deafult permission in "permissions" table

example:

### Permissions Table

| ID   | Name      | Guard Name | Created At          | Updated At |
| ---- | --------- | ---------- | ------------------- | ---------- |
| 1    | user.view | web        | 2025-07-04 12:24:24 | NULL       |
| 2    | role.view | web        | NULL                | NULL       |
| 3    | user.edit | web        | 2025-07-04 12:32:17 | NULL       |


##  Step 3: Prepare Role CRUD

use "Spatie\Permission\Models\Role" for Role crud

- load all the permissions you wan in user creator and select permission and store in array public $selectedPermissions = [];

- now when you save the role after that use spati's method with the selected permission in specific role

$this->role->syncPermissions($this->selectedPermissions);

 It stores data in the model_has_permissions table.
 🧩 Table Structure: model_has_permissions
Column  Description
permission_id   ID of the permission
model_type  Class name (e.g., App\Models\Role)
model_id    ID of the model (e.g., roles.id)

 This table tracks which roles or users have which permissions.

 ⛔ It Does Not Store Anything in role_has_permissions
If you're syncing permissions directly on a role, it updates role_has_permissions, not model_has_permissions.

So:

When you run $role->syncPermissions(), it updates the role_has_permissions table.

When you run $user->syncPermissions(), it updates model_has_permissions.

✅ Summary:

### Permission Storage Mapping

| Target Model | Stores In             |
| ------------ | --------------------- |
| Role         | role_has_permissions  |
| User         | model_has_permissions |


Step 4: Prepare User Crud

- assigne the role id to the user while creating user

```php
  $this->user->syncRoles([$role->name]);

 $additionalPermissions = array_diff(
                $this->selectedPermissions,
                $this->rolePermissions
            );

            $this->user->syncPermissions($additionalPermissions);


```

syncRoles() removes all existing roles and assigns the new role ($role->name) to the user

1. $this->user->syncRoles([$role->name]);
   Updates model_has_roles

It removes any existing role(s) for the user and adds the new one.

If your user model is App\Models\User, Spatie will store:

model_type = 'App\Models\User'

model_id = [user's ID]

role_id = [role ID from roles table]

2. $this->user->syncPermissions($additionalPermissions);
   Updates model_has_permissions

Removes all direct permissions assigned to the user.

Then inserts only the ones in $additionalPermissions.

Like with roles, it uses:

model_type = 'App\Models\User'

model_id = [user's ID]

permission_id = [from permissions table]

## Step 5 : create helper and use it for permission or you can cheke with Auth::user()->can(permission_name)

if (! function_exists('checkPermission')) {
function checkPermission($permissions)
    {
        $user = Auth::user();

​        if (! $user) {
​            return false;
​        }
​    
​        if ($user->is_admin == 1) {
​            return true;
​        }
​    
​        // If multiple permissions are provided, check if any of them are allowed
​        if (is_array($permissions)) {
​            foreach ($permissions as $permi) {
​                if ($user->can($permi)) {
​                    return true;
​                }
​            }
​    
​            return false;
​        }
​    
​        return $user->can($permissions);
​    }

}



```php
`<?php`

`namespace App\Livewire\Admin\User;`

`use App\Models\User;`

`use Illuminate\Support\Facades\Hash;`

`use Illuminate\Validation\Rules\Password;`

`use Livewire\Component;`

`use Livewire\Features\SupportFileUploads\WithFileUploads;`

`use Spatie\Permission\Models\Permission;`

`use Spatie\Permission\Models\Role;`

`class UserCreator extends Component`

`{`

    `use WithFileUploads;`

    `public $id;`

    `public User $user;`

    `public $is_admin = false;`

    `public $userId;`

    `public $role_id;`

    `public $roles;`

    `public $password;`

    `public $password_confirmation;`

    `public $selectedPermissions = [];`

    `public $rolePermissions = [];`

    `public $userAdditionalPermissions = [];`

    `public $roleAdditionalPermissions = [];`

    `protected $listeners = [`

        `'editUser' => 'editUser',`

    `];`

    `protected function rules()`

    `{`

        `return [`

            `'user.name' => [`

                `'required',`

                `'string',`

                `'max:255',`

            `],`

            `'user.email' => [`

                `'required',`

                `'email',`

                `'unique:users,email,'.($this->user->id ?? 'NULL'),`

                `'max:255',`

            `],`

            `'is_admin' => 'nullable|boolean',`

            `'password' => ($this->user->id) ? ['nullable', Password::defaults(), 'min:8', 'max:12'] : ['required', 'confirmed', Password::defaults(), 'min:8', 'max:12'],`

            `'role_id' => [$this->is_admin ? 'nullable' : 'required', 'integer', 'exists:roles,id'],`

        `];`

    `}`

    `public function mount()`

    `{`

        `if (! checkPermission('user.create')) {`

            `$this->notify([`

                `'type' => 'danger',`

                `'message' => ("You're not authorized to access this feature"),`

            `], true);`

            `return redirect()->route('admin.dashboard');`

        `}`

        `$this->id = $this->getId();`

        `$userId = request()->route('userId') ?? null;`

        `$this->user = ($userId) ? User::findOrFail($userId) : new User;`

        `$this->is_admin = $this->user->is_admin;`

        `$this->roles = Role::where('name', '!=', 'Admin')->pluck('name', 'id');`

        `$this->role_id = ($userId && ! empty($this->user->role_id)) ? optional($this->user->roles->first())->id : null;`

        `if ($this->role_id) {`

            `$this->loadPermissions($this->role_id);`

        `}`

    `}`

    `public function updatedRoleId($roleId)`

    `{`

        `// Save current additional permissions for the existing role`

        `if ($this->role_id) {`

            `if ($this->user->role_id == $this->role_id) {`

                `$this->roleAdditionalPermissions[$this->role_id] = array_diff(`

                    `$this->selectedPermissions,`

                    `$this->rolePermissions`

                `);`

            `} else {`

                `$this->roleAdditionalPermissions = [];`

            `}`

        `}`

        `$this->loadPermissions($roleId);`

        `// Restore additional permissions if available for the selected role`

        `$this->userAdditionalPermissions = $this->roleAdditionalPermissions[$roleId] ?? [];`

        `$this->selectedPermissions = array_merge(`

            `$this->rolePermissions,`

            `$this->userAdditionalPermissions`

        `);`

    `}`

    `private function loadPermissions($roleId)`

    `{`

        `// Clear previous permissions`

        `$this->rolePermissions = [];`

        `$this->userAdditionalPermissions = [];`

        `$this->selectedPermissions = [];`

        `if (! empty($roleId) && ! $this->is_admin) {`

            `$role = Role::findOrFail($roleId);`

            `// Get role permissions`

            `$this->rolePermissions = $role->permissions->pluck('name')->toArray();`

            `// Check if there are saved additional permissions for this role`

            `if (isset($this->roleAdditionalPermissions[$roleId])) {`

                `$this->userAdditionalPermissions = $this->roleAdditionalPermissions[$roleId];`

            `} else {`

                `// Calculate user-specific permissions not included in the role`

                `$userPermissions = $this->user->permissions->pluck('name')->toArray();`

                `$this->userAdditionalPermissions = array_diff($userPermissions, $this->rolePermissions);`

            `}`

            `// Combine role permissions and additional permissions`

            `$this->selectedPermissions = array_merge(`

                `$this->rolePermissions,`

                `$this->userAdditionalPermissions`

            `);`

        `}`

    `}`

    `public function save()`

    `{`

        `if (checkPermission(['user.create'])) {`

            `$this->validate();`

            `try {`

                `$role = $this->is_admin`

                    `? Role::where('name', 'Admin')->first()`

                    `: Role::find($this->role_id);`

                `$this->user->is_admin = $this->is_admin ?? false;`

                `if (! empty($this->password)) {`

                    `$this->user->password = Hash::make($this->password);`

                `}`

                `$this->user->role_id = $role ? $role->id : null;`

                `$this->user->save();`

                `if ($role) {`

                    `$this->user->syncRoles([$role->name]);`

                `}`

                `$additionalPermissions = array_diff(`

                    `$this->selectedPermissions,`

                    `$this->rolePermissions`

                `);`

                `$this->user->syncPermissions($additionalPermissions);`

                `$this->notify([`

                    `'type' => 'success',`

                    `'message' => $this->user->wasRecentlyCreated`

                        `? ('User created successfully')`

                        `: ('User updated successfully'),`

                `], true);`

                `$this->redirect(route('admin.users'));`

            `} catch (\Exception $e) {`

                `$this->notify([`

                    `'type' => 'danger',`

                    `'message' => ('User creation failed'),`

                `], true);`

            `}`

        `}`

    `}`

    `public function getPermissionProperty()`

    `{`

        `return Permission::all();`

    `}`

    `public function render()`

    `{`

        `return view('livewire.admin.user.user-creator');`

    `}`

`}`


```

Helper Function

```php

if (! function_exists('checkPermission')) {

    function checkPermission($permissions)

    {

        $user = Auth::user();

        if (! $user) {

            return false;

        }

        if ($user->is_admin == 1) {

            return true;

        }

        // If multiple permissions are provided, check if any of them are allowed

        if (is_array($permissions)) {

            foreach ($permissions as $permi) {

                if ($user->can($permi)) {

                    return true;

                }

            }

            return false;

        }

        return $user->can($permissions);

    }

}

<?php

namespace App\Livewire\Admin\Role;

use Auth;

use Livewire\Component;

use Livewire\WithPagination;

use Spatie\Permission\Models\Permission;

use Spatie\Permission\Models\Role;

class RoleCreator extends Component

{

    use WithPagination;

    public Role $role;

    public $selectedPermissions = [];

    public $role_id;

    public $assigne_from_contact;

    public function mount($roleId = null)

    {

        // if (! Auth::user()->is_admin) {

        //     $this->notify(['type' => 'danger', 'message' => t('access_denied_note')], true);

        //     return redirect(route('admin.dashboard'));

        // }

        $this->role = ($roleId) ? Role::findOrFail($roleId) : new Role;

        if ($roleId) {

            $this->selectedPermissions = $this->role->permissions->pluck('name')->toArray();

        }

    }

    protected function rules()

    {

        return [

            'role.name' => [

                'required',

                'unique:roles,name,'.($this->role->id ?? 'NULL'),

                'max:255',

            ],

        ];

    }

    public function save()

    {

        if (checkPermission(['role.create', 'role.edit'])) {

            $this->validate();

            try {

                $this->role->save();

                $this->role->syncPermissions($this->selectedPermissions);

                $this->notify(['type' => 'success', 'message' => ('Role saved successfully')], true);

                return redirect()->intended(route('admin.roles', absolute: false));

            } catch (\Exception $e) {

                app_log('Failed to save role: '.$e->getMessage(), 'error', $e, [

                    'role_id' => $this->role->id ?? null,

                    'selectedPermissions' => $this->selectedPermissions,

                ]);

                $this->notify(['type' => 'danger', 'message' => ('Role save failed')]);

            }

        }

    }

    public function getPermissionProperty()

    {

        return Permission::all();

    }

    public function render()

    {

        return view('livewire.admin.role.role-creator');

    }

}

```


## Permission Seeder


```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            'source.view',
            'source.create',
            'source.edit',
            'source.delete',

            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            'status.view',
            'status.create',
            'status.edit',
            'status.delete',

            'group.view',
            'group.create',
            'group.edit',
            'group.delete',

            'contact.view',
            'contact.create',
            'contact.edit',
            'contact.delete',
            'contact.bulk_import',
            'contact.view_own',

            'system_settings.view',
            'system_settings.edit',

            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            'email_template.view',
            'email_template.edit',

            // AI Assistant Permissions
            'ai_assistant.view',
            'ai_assistant.create',
            'ai_assistant.edit',
            'ai_assistant.delete',
            'ai_assistant.chat',

        ];

        foreach ($permissions as $permission) {
            Permission::updateOrInsert(['name' => $permission, 'guard_name' => 'web']);
        }
    }
}

```