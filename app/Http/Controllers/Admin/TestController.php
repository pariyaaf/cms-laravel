<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Post;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;



class TestController extends Controller
{
    public function index() {
        $courses = Article::latest()->get();
        return view('Admin.test.index',compact('courses'));

    }

    public function single(Article $article) :RedirectResponse
     {
        auth()->loginUsingId(1);
        if(!Gate::allows('show-course',$article)) {
            dd($article);
            return view('Admin.test.index');
        }
        abort(403, 'dont access to it');

    }
}
