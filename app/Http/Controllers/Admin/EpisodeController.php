<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SetTimeTrait;
use App\Http\Requests\Admin\EpisodeRequest;
use App\Models\Episode;
use  Illuminate\View\View;
class EpisodeController extends Controller
{
    use SetTimeTrait;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $episodes = Episode::latest()->paginate(20);
        return view('Admin.episodes.index',compact('episodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.episodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EpisodeRequest $request)
    {
        try{
            
            // $course = Course::findOrfail($request->input('course_id'));
            // $episode = $course->episode()->create($request->all());
            $request['body'] = 'nothing';
            $episode = Episode::create($request->all());
            $this->setCoursesTime($episode);
   

            return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

            // return redirect()->route('Admin.articles.create');

    } catch(\Exception $e){
        dd($e);
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.
        // return redirect(route('articles.index'));
    }
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
        $episode = Episode::findOrFail($id);
        return view('Admin.episodes.edit',compact('episode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EpisodeRequest $request, string $id)
    {
        $episode =Episode::findOrFail($id);
        try{
            $episode->update($request->all());
            $this->setCoursesTime($episode);
            return back();
        } catch(\Exception $e) {
            dd($e);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $episode = Episode::findOrFail($id);
        $episode->delete();
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
