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
            <form action="{{route('admin.books.book-details.store', $data['book']->id)}}" method="post">
                @csrf
{{--                <div class="m-2 form-group text-right">--}}
{{--                    <label for="book_id">آی دی کتاب <span class="text-danger">(الزامی)</span></label>--}}
                    <input  type="number" hidden id="book_id" name="book_id" value="{{$data['book']->id}}">
{{--                </div>--}}
                <div class="m-2 form-group text-right">
                    <label for="writter_id">آی دی نویسنده کتاب </label>
                    <input class="form-control" type="number" id="writter_id" name="writter_id" value="{{old('writter_id')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="publisher_id">آی دی ناشر </label>
                    <input class="form-control" type="number" id="publisher_id" name="publisher_id" value="{{old('publisher_id')}}">
                </div>

                <div class="m-2 form-group text-right">
                    <label for="publication_date">تاریخ نشر</label>
                    <input class="form-control" type="date" id="publication_date" name="publication_date" value="{{old('publication_date')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="publication_place">محل نشر</label>
                    <input class="form-control" type="text" id="publication_place" name="publication_place" value="{{old('publication_place')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="edition"> نوبت چاپ </label>
                    <input class="form-control" type="number" id="edition" name="edition" value="{{old('edition')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="edit_version">ویراست</label>
                    <input class="form-control" type="number" id="edit_version" name="edit_version" value="{{old('edit_version')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="number_of_pages">صفحات</label>
                    <input class="form-control" type="number" id="number_of_pages" name="number_of_pages" value="{{old('number_of_pages')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="translation">نام ترجمه</label>
                    <input class="form-control" type="text" id="translation" name="translation" value="{{old('translation')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="translator">نام مترجم</label>
                    <input class="form-control" type="text" id="translator" name="translator" value="{{old('translator')}}">
                </div>
                <div class="m-2 form-group text-right">
                    <label for="resources">ریسورسها</label>
                    <input class="form-control" type="text" id="resources" name="resources" value="{{old('resources')}}">
                </div>
                <div class="m-2 form-group">
                    <input class="form-control btn-success" type="submit" value="ایجاد کتاب">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
