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



    public function testUploadImage($request) {
        dd(5);
        $validator = \Validator::make(request()->all(),[
            'name'=> 'required',
            'file'=>'required'
        ]);
    
        if($validator->fails()){
            return $validator->errors()->all();
        }
        return request('massage');
        if($inputName) {
            // $img = $request->{$inputName};
            $img = $inputName;
            //get extention of file
            $ext = $img->getClientOriginalExtension();

            //get date
            $time = Carbon::now();
            $imgName = 'media_'.$time.'.'.$ext;

            $path_300 = '/uploads/300/';
            $path_600 = '/uploads/600/';
            $path_900 = '/uploads/900/';

            $mainImage = $img->move(public_path($path), $imgName);
            copy(public_path($path)."/".$imgName, public_path($path_300).  'media_'.$time.'_'.'300.'.$ext);
            copy(public_path($path)."/".$imgName, public_path($path_600).  'media_'.$time.'_'.'600.'.$ext);
            copy(public_path($path)."/".$imgName, public_path($path_900).  'media_'.$time.'_'.'900.'.$ext);

            //delete old file if exists
            if(File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }
            $images = [
                'thumb'=>$path.'/'.$imgName,
                'sizes' => [
                    $path.'/'.$imgName,
                    $path_300.'media_'.$time.'_'.'300.'.$ext,
                    $path_600.'media_'.$time.'_'.'600.'.$ext,
                    $path_900.'media_'.$time.'_'.'900.'.$ext
                ]

            ];
            return $images;    

        }
    }
}
