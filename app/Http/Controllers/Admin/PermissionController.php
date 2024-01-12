<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\View\View;
use App\Models\Permission;
use App\Http\Requests\Admin\RolePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View 
    {
        $permissions = Permission::latest()->paginate(25);
        return view('Admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('Admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolePermissionRequest $request)
    {
        $role = Permission::create($request->all());
        $permissions = Permission::latest()->paginate(25);
        return view('Admin.permissions.index', compact('permissions'));    }


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
        $permission = Permission::findOrfail($id);

        return view('Admin.permissions.edit', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolePermissionRequest $request, string $id)
    {

        $permission = Permission::findorFail($id);
        $permission->update($request->all());//fillable dont get perm_id

        //خودش هندل میکنه دیتچ کردن و اتچ کردن رو
        // $role->permission()->sync($request->input('permission_id'));

        $permissions = Permission::latest()->paginate(25);
        return view('Admin.permissions.index', compact('permissions')); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perm = Permission::findOrFail($id);
        $perm->delete();
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
