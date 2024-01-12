@extends('Admin.master')
@section('script')
    <script src="/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('#course_id').selectpicker();
        })
    </script>
    <script>
        CKEDITOR.replace('description' ,{
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl :  '/admin/panel/upload-image'
        });
    </script>
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                ثبت نقش برای کاربر 
                <!-- <a href="{{route('admin.roles.create')}}" class="btn btn-primary">ارسال مقاله جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.levels.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('Admin.section.errors')

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="user_id" class="control-label"> کاربران </label>
                        <select class="form-control" name="user_id" id="user_id" data-live-search="true">
                            @foreach(App\Models\User::latest()->get() as $user)
                                <option value="{{ $user->id }}">{{ $user->email }} -> {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="role_id" class="control-label">نقش ها </label>
                        <select class="form-control" name="role_id[]" id="role_id" multiple>
                            @foreach(App\Models\Role::latest()->get() as $role)
                                <option value="{{ $role->id }}">{{ $role->label }}:{{ $role->label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ایجاد سطح دسترسی
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection