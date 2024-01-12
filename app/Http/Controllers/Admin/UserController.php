<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
    public function index() :View 
    {
        // $this->authorize('manage-user'); عین همون گذاشتن میدل ور عمل میکنه
        $users = User::latest()->paginate(25);
        return view('Admin.users.index', compact('users'));
    }


    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
