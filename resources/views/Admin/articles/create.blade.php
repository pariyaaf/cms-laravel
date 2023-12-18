@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                ایجاد مقاله
                <!-- <a href="{{route('admin.articles.create')}}" class="btn btn-primary">ارسال مقاله جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.articles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="title"  class="control-label" >عنوان مقاله</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان مقاله را وارد کنید"
                    value="{{old('title')}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="description"  class="control-label" >توضیحات مقاله</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="توضیحات  مقاله را وارد کنید"
                        value="{{old('description')}}">
                    <div class="col-sm-12">
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="body"  class="control-label" > متن</label>
                        <textarea row="5" class="form-control" name="body" id="body" placeholder="متن مقاله را وارد کنید"
                        ></textarea>
                    </div>
                </div>

                <div class="form-group">
                <div class="col-sm-6">
                        <label for="image"  class="control-label" >تصویر اصلی</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="تصویر را انتخاب کنید"
                        value="{{old('image')}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="tags"  class="control-label" > تگ های مقاله</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ های مقاله را وارد کنید"
                        value="{{old('tags')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ارسال مقاله
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection