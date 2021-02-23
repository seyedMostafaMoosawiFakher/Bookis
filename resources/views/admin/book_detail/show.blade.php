@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="col text-center ">
        <div class="row text-center justify-content-center m-2">
        </div>
        <div class="row text-center justify-content-center m-3">
            <!-- SIMPLE CARD -->
            <div class="card " >
            <button class="btn btn-info btn-block  p-2" onclick = 'window.location.href = "{{route('admin.books.book-details.index',$data['book_detail']->book_id)}}"'> بازگشت </button>
                <div class="card-body">
                    <h4 class="card-title">نام کتاب</h4>
                    <h6 class="card-subtitle text-muted">{{$data['book']->name}}</h6>
                    <div class="card-text">
                        <table class="table table-bordered table-striped mt-3">
                            <tr>
                                <th> ای دی توضیحات </th>
                                <td>{{$data['book_detail']->id}}</td>
                            </tr>                            <tr>
                                <th> ای دی کتاب </th>
                                <td>{{$data['book']->id}}</td>
                            </tr>                            <tr>
                                <th>نویسنده</th>
                                <td>{{$data['book_detail']->writter_id}}</td>
                            </tr>
                            <tr>
                                 <th>ناشر</th>
                            <td>{{$data['book_detail']->publisher_id}}</td>
                            </tr>
                            <tr>
                                <th>تاریخ نشر</th>
                            <td>{{$data['book_detail']->publication_date}}</td>
                            </tr>
                            <tr>
                                <th>محل نشر</th>
                            <td>{{$data['book_detail']->publication_place}}</td>
                            </tr>
                            <tr>
                                <th>نوبت چاپ </th>
                            <td>{{$data['book_detail']->edition}}</td>
                            </tr>
                            <tr>
                                <th>ویراست </th>
                            <td>{{$data['book_detail']->edit_version}}</td>
                            </tr>
                            <tr>
                                <th>تعداد صفحه</th>
                            <td>{{$data['book_detail']->number_of_pages}}</td>
                            </tr>
                            <tr>
                                <th>نام ترجمه کتاب</th>
                            <td>{{$data['book_detail']->translation}}</td>
                            </tr>
                            <tr>
                                <th>نام مترجم کتاب</th>
                            <td>{{$data['book_detail']->translator}}</td>
                            </tr>
                            <tr>
                                <th>منابع کتاب</th>
                            <td>{{$data['book_detail']->resources}}</td>
                            </tr>
                        </table>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
