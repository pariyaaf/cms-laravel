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
                ایجاد دوره
                <!-- <a href="{{route('admin.courses.create')}}" class="btn btn-primary">ایجاد دوره جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.courses.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="title"  class="control-label" >عنوان دوره</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان دوره را وارد کنید"
                    value="{{old('title')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="type"  class="control-label" >نوع دوره</label>
                        <select type="type" class="form-control" name="type" id="type" placeholder="نوع دوره را انتخاب کنید"
                    value="{{old('type')}}">
                        <option value="vip">اعضای ویژه</option>
                        <option value="free">رایگان</option>
                        <option value="cash">نقدی</option>
                    </select>
                    </div>
                </div>
                <!-- <div class="form-group">
                    <div class="col-sm-12">
                        <label for="description"  class="control-label" >توضیحات دوره</label>
                        <textarea row="5" class="form-control" name="description" id="description" placeholder="توضیحات  مقاله را وارد کنید"
                       > {{old('description')}}</textarea>
                    <div class="col-sm-12">
                </div> -->

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="body"  class="control-label" > متن</label>
                        <textarea row="5" class="form-control" name="body" id="body" placeholder="متن دوره را وارد کنید"
                        ></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="images"  class="control-label" >تصویر اصلی</label>
                    <input type="file" class="form-control" name="images" id="images" placeholder="تصویر را انتخاب کنید"
                    value="{{old('image')}}">
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="price"  class="control-label" >  قیمت دوره</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="ثیمت  دوره را وارد کنید"
                        value="{{old('price')}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="tags"  class="control-label" > تگ های دوره</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ های دوره را وارد کنید"
                        value="{{old('tags')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ارسال دوره
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection