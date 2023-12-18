@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                مقالات
                <a href="{{route('admin.articles.create')}}" class="btn btn-primary">ارسال مقاله جدید</a>
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>عنوان مقاله</th>
                    <th>تعداد نظرات</th>
                    <th>مقدار بازدید</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                <tr>
                    <td><a href="{{$article->path()}}" >{{$article->title}}</a></td>
                    <td>{{$article->commentCount}}</td>
                    <td>{{$article->viewCount}}</td>
                    <td>
                        <form action="{{route('admin.articles.destroy' ,$article->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <div class="btn-group btn-group-xs">
                            <a class="btn btn-primary" href="{{route('admin.articles.edit' ,$article->id)}}"></a>
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </div>
                        </form>
                    </td>
                    <!-- <td>libero</td> -->
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection