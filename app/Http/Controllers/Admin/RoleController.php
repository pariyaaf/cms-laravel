<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use  Illuminate\View\View;
use App\Http\Requests\Admin\RolePermissionRequest;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $roles = Role::latest()->paginate(25);
        return view('Admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('Admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {
        $this->validate($request, [
            'permission_id'=>'required'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permission_id'));

        $roles = Role::latest()->paginate(25);
        return view('Admin.roles.index', compact('roles'));    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) 
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) : View
    {
        $role = Role::findOrfail($id);

        return view('Admin.roles.edit', compact('role'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolePermissionRequest $request, string $id)
    {
        $this->validate($request, [
            'permission_id'=>'required'
        ]);
        $role = Role::findorFail($id);
        $role->update($request->all());//fillable dont get perm_id

        //خودش هندل میکنه دیتچ کردن و اتچ کردن رو
        $role->permissions()->sync($request->input('permission_id'));

        $roles = Role::latest()->paginate(25);
        return view('Admin.roles.index', compact('roles')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
