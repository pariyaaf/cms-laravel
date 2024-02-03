<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Course;
use Carbon\Carbon;
use  Illuminate\View\View;
use SEO;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;


use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() : View
    {
        // cache()->pull('courses');
        // cache()->pull('articles');

        SEOMeta::setTitle(' سایت پریا');
        SEOMeta::setDescription('وب سایت آموزشی');


        if(cache()->has('articles')) {
            $articles = cache('articles');
        } else {
            $articles = Article::latest()->take(8)->get();
            cache(['articles'=> $articles, Carbon::now()->addDays(1)]);
        }

        if(cache()->has('courses')) {
            $courses = cache('courses');
        } else {
            $courses = Course::latest()->take(4)->get();
            cache(['courses'=> $courses, Carbon::now()->addDays(1)]);
        }


        return view('Home.index', compact('articles','courses'));
    }

    public function comment(Request $request) {

        $this->validate($request, [
                    'comment' => 'required|min:5'
        ]);


        auth()->user()->comments()->create($request->all());
        return back();

        // Comment::create(array_merge([
        //     'user_id' => auth()->id,
        //     $request->all()
        // ]));

    }
}
