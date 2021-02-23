@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col text-right">
        <div class="row ">
            @if(session('success'))
                <div class="col h4 text-success">{{session('success')}}</div>
            @endif
        </div>
        <div class="row-8 text-center">
            <a class="btn btn-primary w-75 my-2 " href="{{route('admin.books.book-details.create', $data['book'])}}"> ساخت توضیحات جدید برای کتاب حاضر</a>
        </div>
        <div class="row text-center m-3">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ای دی</th>
                        <th>ای دی کتاب</th>
                        <th>نویسنده</th>
                        <th>ناشر</th>
                        <th>تاریخ نشر</th>
                        <th>محل نشر</th>
                        <th>چاپ چندم</th>
                        <th>ویراست چندم</th>
                        <th>تعداد صفحه</th>
                        <th>نام ترجمه کتاب</th>
                        <th>نام مترجم کتاب</th>
                        <th>منابع کتاب</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['book_details'] as $book_detail)
                        <tr>
                            <td>{{$book_detail->id}}</td>
                            <td>{{$book_detail->book_id}}</td>
                            <td>{{$book_detail->writter_id}}</td>
                            <td>{{$book_detail->publisher_id}}</td>
                            <td>{{$book_detail->publication_date}}</td>
                            <td>{{$book_detail->publication_place}}</td>
                            <td>{{$book_detail->edition}}</td>
                            <td>{{$book_detail->edit_version}}</td>
                            <td>{{$book_detail->number_of_pages}}</td>
                            <td>{{$book_detail->translation}}</td>
                            <td>{{$book_detail->translator}}</td>
                            <td>{{$book_detail->resources}}</td>
                            <td>
                            <a class="btn btn-secondary mb-1 btn-block" href="{{route('admin.books.book-details.show',[$data['book'] , $book_detail])}}">نمایش</a>
                            <a class="btn btn-success mb-1 btn-block" href="{{route('admin.books.book-details.edit', [$data['book'] , $book_detail])}}">ویرایش</a>
                           <form action="{{route('admin.books.book-details.destroy', [$data['book'] ,$book_detail])}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger btn-block" type="submit" value="حذف">
                           </form>
                           </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
        <div class="row justify-content-center my-5">
            {{$data['book_details']->links()}}
        </div>
    </div>
</div>

@endsection
