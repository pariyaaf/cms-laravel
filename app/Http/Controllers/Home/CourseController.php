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
        $course->increment('viewCount');
        Redis::Incr("views.{$course->id}.courses");
        return view('Home.courses');
    }
}
