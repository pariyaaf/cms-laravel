@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                مقالات
                <div class="btn-group">
                <a href="{{route('admin.courses.create')}}" class="btn btn-primary">ایجاد دوره جدید</a>
                <a href="{{route('admin.episode.index')}}" class="btn btn-danger">  بخش اپیزود ها</a>

                </div>
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>عنوان دوره</th>
                    <th>تعداد نظرات</th>
                    <th>مقدار بازدید</th>
                    <th>نوع دوره</th>
                    <th>زمان دوره</th>

                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                <tr>
                    <td><a href="{{$course->path()}}" >{{$course->title}}</a></td>
                    <td>{{$course->commentCount}}</td>
                    <td>{{$course->viewCount}}</td>
                    <td>{{$course->type}}</td>
                    <td>{{$course->time}}</td>

                    <td>
                        @if($course->type =='free')
                            ویژه
                        @elseif ($course->type == 'vip')
                            رایگان
                        @else 
                            نقدی
                        @endif
                    </td>

                    <td>
                        <form action="{{route('admin.courses.destroy' ,$course->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <div class="btn-group btn-group-xs">
                            <a class="btn btn-primary" href="{{route('admin.courses.edit' ,$course->id)}}">ویرایش</a>
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
        <div style="text-align:center">
            {!!$courses->render()!!}
        </div>
    </div>
@endsection