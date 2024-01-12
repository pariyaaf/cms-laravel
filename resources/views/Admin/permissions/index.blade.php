@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                 دسترسی ها 
                <div class="btn-group">
                </div>
                
            </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام دسترسی</th>
                    <th>توضیح دسترسی </th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->label}}</td>
                    <td>
                        <form action="{{route('admin.permissions.destroy' ,$permission->id)}}" method="POST">
                        @csrf
                        @method('delete')

                        <div class="btn-group btn-group-xs">
                            <button type="submit" class="btn btn-danger">حذف</button>
                            <a class="btn btn-primary" href="{{route('admin.permissions.edit' ,$permission->id)}}">ویرایش</a>

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
            {!!$permissions->render()!!}
        </div>
    </div>
@endsection