@extends('Admin.master')


@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                ایجاد دسترسی
                <!-- <a href="{{route('admin.permissions.create')}}" class="btn btn-primary">ارسال مقاله جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.permissions.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name"  class="control-label" >عنوان دسترسی</label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="عنوان دسترسی را وارد کنید"
                    value="{{old('name')}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="label"  class="control-label" >توضیح دسترسی</label>
                        <input type="text" class="form-control" name="label" id="label" placeholder="توضیح دسترسی را وارد کنید"
                    value="{{old('label')}}">
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