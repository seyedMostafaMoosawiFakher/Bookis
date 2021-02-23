@extends('admin.layouts.app')
@section('content')
@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
<div class="container">
    <div class="row justify-content-center " >
        <div class="col">
            <form action="{{route('admin.users.store')}}" method="post">
                @csrf
                <div class="m-2 form-group text-right">
                    <label for="username">نام کاربری <span class="text-danger">(ایمیل یا شماره تلفن همراه معتبر الزامی است.)</span></label>
                    <input class="form-control" type="text" id="username" name="username" value="{{old('username')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="password">رمز عبور </label>
                    <input class="form-control" type="text" id="password" name="password" value="{{old('password')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="email">ایمیل</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{old('email')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="mobile">شماره تلفن همراه</label>
                    <input class="form-control" type="number" id="mobile" name="mobile" value="{{old('mobile')}}">
                </div>
                <div class="m-2 form-group">
                    <input class="form-control btn-success" type="submit" value="ایجاد یوزر">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
