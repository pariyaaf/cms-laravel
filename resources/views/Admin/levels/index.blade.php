@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                کاربران سایت
                <div class="btn-group">
                    <a href="{{route('admin.levels.create')}}" class="btn btn-sm btn-primary">ثبت نقش برای کاربر </a>
                </div>
                
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام کاربری</th>
                    <th>ایمیل </th>
                    <th>نقش </th>
                    <th>وضعیت ایمیل</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    @if(count($role->users)) 
                        @foreach($role->users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <form action="{{route('admin.levels.destroy' ,$user->id)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <div class="btn-group btn-group-xs">
                                        <button type="submit" class="btn btn-danger">حذف</button>
                                        <a class="btn btn-primary" href="{{route('admin.levels.edit' ,$user->id)}}">ویرایش</a>

                                    </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align:center">
            {!!$roles->render()!!}
        </div>
    </div>
@endsection