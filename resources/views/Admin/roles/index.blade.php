@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                 نقش ها
                <div class="btn-group">
                    <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-primary"> ایجاد نقش</a>
                    <a href="{{route('admin.permissions.index')}}" class="btn btn-sm btn-warning">بخش دسترسی ها</a>
                </div>
                
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام نقش</th>
                    <th>توضیح نقش </th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->name}}</td>
                    <td>{{$role->label}}</td>
                    <td>
                        <form action="{{route('admin.roles.destroy' ,$role->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <div class="btn-group btn-group-xs">
                            <button type="submit" class="btn btn-danger">حذف</button>
                            <a class="btn btn-primary" href="{{route('admin.roles.edit' ,$role->id)}}">ویرایش</a>

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
            {!!$roles->render()!!}
        </div>
    </div>
@endsection