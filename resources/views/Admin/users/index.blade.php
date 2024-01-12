@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                کاربران سایت
                <div class="btn-group">
                    <a href="{{route('admin.roles.index')}}" class="btn btn-sm btn-primary">سطوح دسترسی</a>
                    <a href="{{route('admin.levels.index')}}" class="btn btn-sm btn-warning">کاربران مدیریت</a>
                </div>
                
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام کاربری</th>
                    <th>ایمیل </th>
                    <th> نوع کاربر</th>
                    <th>وضعیت ایمیل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td><a href="" >{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->level}}</td>
                    <td>
                        <form action="{{route('admin.users.destroy' ,$user->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <div class="btn-group btn-group-xs">
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
            {!!$users->render()!!}
        </div>
    </div>
@endsection