@extends('Admin.master')

@section('script')
    <script src="/ckeditor/ckeditor.js"></script>file
    <script>
        CKEDITOR.replace('body', {
            filebrowserUploadUrl : '/admin/panel/upload-image',
            filebrowserImageUploadUrl : '/admin/panel/upload-image'
        });
    </script>
@endsection

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                ویرایش مقاله
                <!-- <a href="{{route('admin.articles.create')}}" class="btn btn-primary">ارسال مقاله جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.roles.update' ,$role->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name"  class="control-label" >عنوان نقش</label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="عنوان مقش را وارد کنید"
                    value="{{$role->name}}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="permission_id" class="control-label">دسترسی ها </label>
                    <select class="form-control" name="permission_id[]" id="permission_id" multiple>
                        @foreach(App\Models\Permission::latest()->get() as $permission)
                            <option value="{{ $permission->id }}" {{ in_array(trim($permission->id) , $role->permissions->pluck('id')->toArray()) ? 'selected' : ''  }}>{{ $permission->name }} - {{ $permission->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="label"  class="control-label" >توضیح نقش</label>
                        <input type="text" class="form-control" name="label" id="label" placeholder="توضیح نقش را وارد کنید"
                    value="{{$role->label}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ویرایش نقش
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection