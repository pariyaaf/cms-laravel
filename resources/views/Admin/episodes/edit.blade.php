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
                ویرایش اپیزود
                <!-- <a href="{{route('admin.episode.create')}}" class="btn btn-primary">ارسال دوره جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.episode.update' ,$episode->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="title"  class="control-label" >عنوان اپیزود</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان دوره را وارد کنید"
                    value="{{$episode->title}}">
                    </div>
                </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="course_id" class="control-label">دوره مرتبط</label>
                    <select class="form-control" name="course_id" id="course_id">
                        @foreach(App\Models\Course::latest()->get() as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="type"  class="control-label" >نوع اپیزود</label>
                        <select type="type" class="form-control" name="type" id="type" placeholder="نوع دوره را انتخاب کنید"
                    value="{{{$episode->type}}}}">
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
                        <label for="description"  class="control-label" > متن</label>
                        <textarea row="5" class="form-control" name="description" id="description" placeholder="متن دوره را وارد کنید"
                        >{{$episode->description}}</textarea>
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label for="images"  class="control-label" >تصویر اصلی</label>
                    <input type="file" class="form-control" name="images" id="images" placeholder="تصویر را انتخاب کنید"
                    value="{{old('image')}}">
                </div> -->
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="episodeNumber"  class="control-label" >  شماره اپیزود</label>
                        <input type="text" class="form-control" name="episodeNumber" id="episodeNumber" placeholder="شماره  اپیزود را وارد کنید"
                        value="{{$episode->episodeNumber}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="time"  class="control-label" >  زمان اپیزود</label>
                        <input type="text" class="form-control" name="time" id="time" placeholder="زمان  اپیزود را وارد کنید"
                        value="{{$episode->time}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="videoUrl"  class="control-label" >  لینک اپیزود</label>
                        <input type="text" class="form-control" name="videoUrl" id="videoUrl" placeholder="لینک  اپیزود را وارد کنید"
                        value="{{$episode->videoUrl}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="tags"  class="control-label" > تگ های اپیزود</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ های اپیزود را وارد کنید"
                        value="{{$episode->tags}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ویرایش اپیزود
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection