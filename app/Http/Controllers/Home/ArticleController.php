<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Redis;


class ArticleController extends Controller
{
    public function single(Article $article): View {
        $article->increment('viewCount');
        Redis::Incr("views.{$article->id}.articles");
        return view('Home.article');    }
}
