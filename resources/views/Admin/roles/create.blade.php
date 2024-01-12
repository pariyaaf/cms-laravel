@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>
                ایجاد نقش
                <!-- <a href="{{route('admin.roles.create')}}" class="btn btn-primary">ارسال مقاله جدید</a> -->
            </h2>
        </div>
        <div class="table-responsive">
   

            <form class="form-horizontal"action="{{route('admin.roles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('Admin.section.errors')
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="name"  class="control-label" >عنوان نقش</label>
                        <input type="name" class="form-control" name="name" id="name" placeholder="عنوان مقش را وارد کنید"
                    value="{{old('name')}}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <label for="permission_id" class="control-label">دسترسی ها </label>
                    <select class="form-control" name="permission_id[]" id="permission_id" multiple>
                        @foreach(App\Models\Permission::latest()->get() as $perm)
                            <option value="{{ $perm->id }}">{{ $perm->label }}:{{ $perm->label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="label"  class="control-label" >توضیح نقش</label>
                        <input type="text" class="form-control" name="label" id="label" placeholder="توضیح نقش را وارد کنید"
                    value="{{old('label')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">
                            ساخت نقش
                        </button>
                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection