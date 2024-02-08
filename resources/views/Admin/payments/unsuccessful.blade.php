@extends('Admin.master')

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2> پرداخت های تایید نشده </h2>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>نام کاربر</th>
                    <th>نام درس</th>
                    <th>قیمت</th>
                    <th> شماره رفرنس </th>
                    <th>  نوع پرداخت </th>
                    <th>تنظیمات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                <tr>
                        @if($payment->user)
                        <td>{{ $payment->user->name }}</td>
                        @else
                        <td>کاربر یافت نشد</td>
                         @endif
                         @if($payment->course_id == 'vip')
                            <td><a href="">vip</a></td>
                            <td>{{ $payment->price }} تومن</td>
                            <td>{{ $payment->resnumber}}</td>
                            <td>بابت عضویت ویژه</td>
                        @else
                        <td><a href="{{ $payment->course->path()}}">{{  $payment->course->title }}</a></td>
                        <td>{{ $payment->price }} تومن</td>
                        <td>{{ $payment->resnumber}}</td>
                        <td>{{ $payment->course->type }}</td>
                        @endif
                        <td>
                        <form action="{{route('admin.payments.destroy' ,$payment->id)}}" method="POST">
                        @csrf
                        @method('delete')
                                <div class="btn-group btn-group-xs">
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </div>
                            </form>
                            <form action="{{route('admin.payments.update' ,$payment->id)}}" method="POST">
                                @csrf
                                @method('patch')
                                    <button type="submit" class="btn btn-xs btn-success">تایید</button>
                                </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center">
            {!! $payments->render() !!}
        </div>
    </div>
@endsection