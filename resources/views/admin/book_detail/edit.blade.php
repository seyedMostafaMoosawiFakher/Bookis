@extends('admin.layouts.app')
@section('content')
{{--    اتریبیوت ست شده در مدل است.--}}
{{--      {{$data['book_detail']->asd}}--}}
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
            <form action="{{route('admin.books.book-details.update',[$data['book']->id ,$data['book_detail']])}}" method="post">
                @csrf
                @method('PUT')
                <input class="form-control" hidden type="number" id="book_id" name="book_id" value="{{$data['book']->id}}">
                <div class="m-2 form-group text-right">
                    <label for="writter_id">آی دی نویسنده کتاب </label>
                    <input class="form-control" type="number" id="writter_id" name="writter_id" value="{{$data['book_detail']->writter_id}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="publisher_id">آی دی ناشر </label>
                    <input class="form-control" type="number" id="publisher_id" name="publisher_id" value="{{$data['book_detail']->publisher_id}}">
                </div>

                <div class="m-2 form-group text-right">
                    <label for="publication_date">تاریخ نشر</label>
                    <input class="form-control" type="date" id="publication_date" name="publication_date" value="{{$data['book_detail']->publication_date}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="publication_place">محل نشر</label>
                    <input class="form-control" type="text" id="publication_place" name="publication_place" value="{{$data['book_detail']->publication_place}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="edition"> نوبت چاپ </label>
                    <input class="form-control" type="number" id="edition" name="edition" value="{{$data['book_detail']->edition}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="edit_version">ویراست</label>
                    <input class="form-control" type="number" id="edit_version" name="edit_version" value="{{$data['book_detail']->edit_version}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="number_of_pages">صفحات</label>
                    <input class="form-control" type="number" id="number_of_pages" name="number_of_pages" value="{{$data['book_detail']->number_of_pages}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="translation">نام ترجمه</label>
                    <input class="form-control" type="text" id="translation" name="translation" value="{{$data['book_detail']->translation}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="translator">نام مترجم</label>
                    <input class="form-control" type="text" id="translator" name="translator" value="{{$data['book_detail']->translator}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="resources">ریسورسها</label>
                    <input class="form-control" type="text" id="resources" name="resources" value="{{$data['book_detail']->resources}}">
                </div>
                <div class="m-2 form-group">
                    <input class="form-control btn-success" type="submit" value=" ذخیره تغییرات">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
