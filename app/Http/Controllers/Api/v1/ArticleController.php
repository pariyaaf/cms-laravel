<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function articles() {
        if(true) {
            return response(['data'=> 'Unauthorized', 'status'=>401], 401);
        }
        $articles = Article::select('title','id','user_id')->latest()->get();
        return response(['data'=> $articles, 'status'=>200], 200);
    }


    public function comments (Request $request) {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'comment'=> 'required',
        ]);

        if($validator->fails()) {
            return response(['data'=> $validator->arrors->all(), 'status'=>403], 403);

        }
    }
}
