<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use  Illuminate\View\View;
class CourseController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $courses = Course::latest()->paginate(20);
        return view('Admin.courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        return view('Admin.courses.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        try{
                $images = $request->file('images');
                $imagesUrl = $this->uploadImage($images);
                // dd($request->all(), array_merge($request->all() , [ 'images' => $imagesUrl]));
                
                auth()->loginUsingId(1);
                $request->images = $imagesUrl;

                auth()->user()->course()->create(

                    array_merge($request->all() , [ 'images' => $imagesUrl]));

                return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.


        } catch(\Exception $e){
            return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.
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
        $course = Course::findOrFail($id);
        $sized = ['original', 'small', 'medium', 'large'];
        return view('Admin.courses.edit',compact('course','sized'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, string $id)
    {
        $input = $request->all();
        $course =Course::findOrFail($id);
        try{
            if($request->file('images')){
                $images = $request->file('images');
                $input['images'] = $this->uploadImage($images);
                $this->RemoveFile($course->images);

            }
            else {
                $input['images'] = $course->images;
                $input['images']['thumb'] = $input['imagesThumb'];
            }
        

            unset($input['imagesThumb']);
            $course->update($input);
            $courses = Course::latest()->paginate(20);
            return view('Admin.courses.index',compact('courses'));
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
        $course = Course::findOrFail($id);
        $this->RemoveFile($course->images);
        $course->delete();
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
