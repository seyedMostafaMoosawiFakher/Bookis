@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="col text-right">
        <div class="row ">
            @if(session('success'))
                <div class="col h4 text-success">{{session('success')}}</div>
            @endif
        </div>
        <div class="row-8 text-center m-3">
            <a class="btn btn-primary w-75 my-2 " href="{{route('admin.books.create')}}"> ساخت کتاب جدید</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>شناسه</th>
                        <th>نام کتاب</th>
                        <th>موضوع</th>
                        <th>زبان</th>
                        <th>توضیحات</th>
                        <th>نمایش</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                        <th>مشخصات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['books'] as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->name}}</td>
                            <td>{{$book->subject}}</td>
                            <td>{{$book->language}}</td>
                            <td>{{$book->description}}</td>
                            <td><a class="btn btn-secondary" href="{{route('admin.books.show', $book->id)}}">نمایش</a></td>
                            <td><a class="btn btn-success" href="{{route('admin.books.edit', $book->id)}}">ویرایش</a></td>
                            <td>
                                <form action="{{route('admin.books.destroy', $book->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger" type="submit" value="حذف">
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{route('admin.books.book-details.index', $book->id)}}">مشخصات</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
         </div>
        <div class="row justify-content-center my-5">
            {{$data['books']->links()}}
        </div>
    </div>
</div>

@endsection
