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
   

            <form class="form-horizontal"action="{{route('admin.permissions.update' ,$permission->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name"  class="control-label" >عنوان دسترسی</label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="عنوان مقش را وارد کنید"
                    value="{{$permission->name}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="label"  class="control-label" >توضیح دسترسی</label>
                        <input type="text" class="form-control" name="label" id="label" placeholder="توضیح نقش را وارد کنید"
                    value="{{$permission->label}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ویرایش دسترسی
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection