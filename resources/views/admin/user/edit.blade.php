@extends('admin.layouts.app')
@section('content')
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<div class="container" dir="rtl">
    <div class="row  justify-content-center">
        <div class="col">
            <form action="{{route('admin.users.update', $data['user']->id)}}" method="post">
                @csrf
                @method('put')
                <div class="m-2 form-group text-right">
                    <label for="username">نام کارری <span class="text-danger">(الزامی)</span></label>
                    <input class="form-control" type="text" id="username" name="username" value="{{$data['user']->username}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="password"> رمز عبور </label>
                    <input class="form-control" type="text" id="password" name="password" value="{{$data['user']->password}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="email">ایمیل</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{$data['user']->email}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="mobile">شماره تلفن همراه</label>
                    <input class="form-control" type="text" id="mobile" name="mobile" value="{{$data['user']->mobile}}">
                </div>
                <div class="m-2 form-group">
                    <input class="form-control btn-success" type="submit" value="ذخیره تغییرات">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
