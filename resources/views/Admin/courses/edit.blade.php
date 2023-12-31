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
                ویرایش دوره
                <!-- <a href="{{route('admin.courses.create')}}" class="btn btn-primary">ارسال دوره جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.courses.update' ,$course->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="title"  class="control-label" >عنوان دوره</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان دوره را وارد کنید"
                    value="{{ $course->title }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="type"  class="control-label" >نوع دوره</label>
                        <select type="type" class="form-control" name="type" id="type" placeholder="نوع دوره را انتخاب کنید">
                        <option value="vip" {{$course->type == 'vip' ? 'selected' : ''}} >اعضای ویژه</option>
                        <option value="free" {{$course->type == 'free' ? 'selected' : ''}}>رایگان</option>
                        <option value="cash" {{$course->type == 'cash' ? 'selected' : ''}}>نقدی</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="body"  class="control-label" > متن</label>
                        <textarea row="5" class="form-control" name="body" id="body" placeholder="متن دوره را وارد کنید"
                        > {{$course->body}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="tags"  class="control-label" > تگ های دوره</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ های دوره را وارد کنید"
                        value="{{ $course->tags }}">
                    </div>
                </div>

                <div class="form-group">
                <div class="col-sm-6">
                        <label for="price"  class="control-label" >  قیمت دوره</label>
                        <input type="text" class="form-control" name="price" id="price" placeholder="ثیمت  دوره را وارد کنید"
                        value="{{ $course->price}}">
                    </div>
                </div>

                <div class="form-group">
                <div class="col-sm-12">
                    <label for="images" class="control-label">تصویر دوره</label>
                    <input type="file" class="form-control" name="images" id="images" placeholder="تصویر دوره را وارد کنید">
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        @foreach( $course->images['sizes'] as  $index => $image)
                            <div class="col-sm-2">
                                <label class="control-label">
                                    
                                    {{ $sized[$index] }}
                                    <input type="radio" name="imagesThumb" value="{{ $image }}" {{ $course->images['thumb'] == $image ? 'checked' : '' }} />
                                    <a href="{{ $image }}" target="_blank"><img src="{{ $image }}" width="100%"></a>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ویرایش دوره
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection