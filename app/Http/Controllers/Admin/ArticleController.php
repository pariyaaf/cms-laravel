<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ArticleRequest;
use App\Traits\FileUploadTrait;

use App\Models\Article;
use  Illuminate\View\View;


class ArticleController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $articles = Article::latest()->paginate(20);
        return view('Admin.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('Admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        try{
                $images = $request->file('images');
                $imagesUrl = $this->uploadImage($images);

                // dd($request->all(), array_merge($request->all() , [ 'images' => $imagesUrl]));
                
                auth()->loginUsingId(6);
                $request->images = $imagesUrl;
                auth()->user()->article()->create(

                    array_merge($request->all() , [ 'images' => $imagesUrl])
                                );

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
        $article = Article::findOrFail($id);
        $sized = ['original', 'small', 'medium', 'large'];
        return view('Admin.articles.edit',compact('article','sized'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, string $id)
    {
        $input = $request->all();
        $article =Article::findOrFail($id);
        try{
            if($request->file('images')){
                $images = $request->file('images');
                $input['images'] = $this->uploadImage($images);
                $this->RemoveFile($article->images);

            }
            else {
                $input['images'] = $article->images;
                $input['images']['thumb'] = $input['imagesThumb'];
            }
      

            unset($input['imagesThumb']);
            $article->update($input);
            $articles = Article::latest()->paginate(20);
            return view('Admin.articles.index',compact('articles'));
} catch(\Exception $e) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $this->RemoveFile($article->images);
        $article->delete();
        return back();//  زمانی که به صورت پست باشه میشه ازش استفاده کرد.

    }
}
