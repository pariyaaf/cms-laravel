<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\View\View;
use App\Models\Role;
use App\Models\User;


class LevelManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $roles = Role::latest()->with('users')->paginate(20);
        return view('Admin.levels.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('Admin.levels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'=>'required',
            'role_id'=>'required'
        ]);

        User::find($request->input('user_id'))->roles()->sync($request->role_id);
        $roles = Role::latest()->with('users')->paginate(20);
        return view('Admin.levels.index', compact('roles'));    
    }

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
        $user = User::findOrfail($id);

        return view('Admin.levels.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'role_id'=>'required'
        ]);

        $user = User::findorFail($id);
        $user->roles()->sync($request->input('role_id'));

        //خودش هندل میکنه دیتچ کردن و اتچ کردن رو
        $roles = Role::latest()->with('users')->paginate(20);
        return view('Admin.levels.index', compact('roles'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();

        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
