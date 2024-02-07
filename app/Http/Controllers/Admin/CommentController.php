<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use  Illuminate\View\View;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Comment::find(1)->commentable()->get();
        $comments = Comment::where('approved' , 1)->latest()->paginate(20);
        return view('Admin.comments.index', compact('comments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::find($id);
        $comment->update(['approved'=>1]);
        $comment->commentable->increment('commentCount');

        // event()
        alert()->success('عملیات مورد نظر با موفقیت انجام شد','تایید شد');
        return back();

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        if($comment->approved == 1) {
            $comment->commentable->decrement('commentCount');
        }
        $comment->delete();
        alert()->success('عملیات مورد نظر با موفقیت انجام شد','حذف شد');
        return back();
    }

    public function unsuccessful() : View
     {
        $comments = Comment::where('approved',0)->latest()->paginate(20);
        return view('Admin.comments.unapproved', compact('comments'));
    }
}
