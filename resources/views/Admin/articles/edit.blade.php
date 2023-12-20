@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                ویرایش مقاله
                <!-- <a href="{{route('admin.articles.create')}}" class="btn btn-primary">ارسال مقاله جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.articles.update' ,$article->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="title"  class="control-label" >عنوان مقاله</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان مقاله را وارد کنید"
                    value="{{ $article->title }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="description"  class="control-label" >توضیحات مقاله</label>
                        <textarea row="5" class="form-control" name="description" id="description" placeholder="توضیحات  مقاله را وارد کنید"
                       > {{$article->description}}</textarea>
                    <div class="col-sm-12">
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="body"  class="control-label" > متن</label>
                        <textarea row="5" class="form-control" name="body" id="body" placeholder="متن مقاله را وارد کنید"
                        > {{$article->body}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="tags"  class="control-label" > تگ های مقاله</label>
                        <input type="text" class="form-control" name="tags" id="tags" placeholder="تگ های مقاله را وارد کنید"
                        value="{{ $article->tags }}">
                    </div>
                </div>


                <div class="form-group">
                <div class="col-sm-12">
                    <label for="images" class="control-label">تصویر مقاله</label>
                    <input type="file" class="form-control" name="images" id="images" placeholder="تصویر مقاله را وارد کنید">
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        @foreach( $article->images['sizes'] as  $index => $image)
                            <div class="col-sm-2">
                                <label class="control-label">
                                    
                                    {{ $sized[$index] }}
                                    <input type="radio" name="imagesThumb" value="{{ $image }}" {{ $article->images['thumb'] == $image ? 'checked' : '' }} />
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
                            ویرایش مقاله
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection