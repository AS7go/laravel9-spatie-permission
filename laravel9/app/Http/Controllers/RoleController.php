<?php

namespace App\Http\Controllers;

// use App\Models\Role;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        // $roles = Role::orderBy('name')->get(); //виден super-user
        $roles = Role::orderBy('name')->where('name', '!=', 'super-user')->get();

        return view('roles.index', compact([
            'roles'
        ]));
    }

    public function create()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create', compact([
            'permissions'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permissions.*' => 'required|integer|exists:permissions,id',
        ]);

        $newRole = Role::create([
            'name' => $request->name
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $newRole->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role added!');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $role=Role::where('name', '!=', 'super-user')->findOrFail($role->id);
        $permissions = Permission::orderBy('name')->get();

        return view('roles.edit', compact([
            'permissions',
            'role',
        ]));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id',
        ]);
        
        $role=Role::where('name', '!=', 'super-user')->findOrFail($role->id);
        $role->update([
            'name' => $request->name
        ]);
        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Role updated!');
    }

    public function destroy(Role $role)
    {
        // Перед удалением роли необходимо убедиться, что роль не "super-user"
        if ($role->name === 'super-user') {
            return redirect()->back()->with('error', 'You cannot delete the super-user role.');
        }

        // Удаление роли
        $role->delete();

        return redirect()->back()->with('status', 'Role deleted!');
    }
}
