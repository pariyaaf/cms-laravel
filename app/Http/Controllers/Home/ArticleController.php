<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Redis;
use App\Models\Comment;


class ArticleController extends Controller
{
    public function single(Article $article): View {

        $comments = $article->comments()->where('approved',1)->where('parent_id',0)->latest()->with('comments')->get();
        $article->increment('viewCount');
        Redis::Incr("views.{$article->id}.articles");
        return view('Home.article', compact('article','comments'));
        }
}
