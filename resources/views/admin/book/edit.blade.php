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
            <form action="{{route('admin.books.update', $data['book']->id)}}" method="post">
                @csrf
                @method('put')
                <div class="m-2 form-group text-right">
                    <label for="name">نام کتاب <span class="text-danger">(الزامی)</span></label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$data['book']->name}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="subject">موضوع کتاب </label>
                    <input class="form-control" type="text" id="subject" name="subject" value="{{$data['book']->subject}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="language">زبان کتاب</label>
                    <input class="form-control" type="text" id="language" name="language" value="{{$data['book']->language}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="description">توضیحات کتاب</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$data['book']->description}}</textarea>
                </div>
                <div class="m-2 form-group">
                    <input class="form-control btn-success" type="submit" value="ذخیره تغییرات">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
