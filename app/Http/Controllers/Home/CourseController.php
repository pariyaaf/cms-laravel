<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Redis;

class CourseController extends Controller
{
    public function single(Course $course) :View {

        $comments = $course->comments()->where('approved',1)->where('parent_id',0)->latest()->with('comments')->get();

        $course->increment('viewCount');
        Redis::Incr("views.{$course->id}.courses");
        return view('Home.courses',compact('course', 'comments'));
    }
}
