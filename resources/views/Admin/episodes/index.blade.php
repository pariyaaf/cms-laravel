@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                اپیزود ها
                <a href="{{route('admin.episode.create')}}" class="btn btn-primary">ایجاد اپیزود جدید</a>
               
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>عنوان اپیزود</th>
                    <th>تعداد نظرات</th>
                    <th>تعداد بازدید </th>
                    <th>تعداد بازدید </th>
                    <th>وضعیت ویدیو</th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($episodes as $episode)
                <tr>
                    <td><a href="{{$episode->path()}}" >{{$episode->title}}</a></td>
                    <td>{{$episode->commentCount}}</td>
                    <td>{{$episode->viewCount}}</td>
                    <td>{{$episode->downloadCount}}</td>
                    <td>{{$episode->type}}</td>
                    <td>
                        @if($episode->type =='free')
                            ویژه
                        @elseif ($episode->type == 'vip')
                            رایگان
                        @else 
                            نقدی
                        @endif
                    </td>

                    <td>
                        <form action="{{route('admin.episode.destroy' ,$episode->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <div class="btn-group btn-group-xs">
                            <a class="btn btn-primary" href="{{route('admin.episode.edit' ,$episode->id)}}">ویرایش</a>
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
            {!!$episodes->render()!!}
        </div>
    </div>
@endsection