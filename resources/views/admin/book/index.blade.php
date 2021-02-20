@extends('admin.layouts.app')
@section('content')
<div class="container justify-content-center text-center">
    <div class="col">
        <div class="row">
            @if(session('success'))
                <div class="col h3 text-success">{{session('success')}}</div>
            @endif
        </div>
        <div class="row">
            <a class="btn btn-primary btn-block m-2" href="{{route('admin.books.create')}}"> ساخت کتاب جدید</a>
        </div>
        <div class="row">
            <table border="1">
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
                            <td><a class="btn btn-success" href="{{route('admin.books.show', $book->id)}}">نمایش</a></td>
                            <td><a class="btn btn-info" href="{{route('admin.books.edit', $book->id)}}">ویرایش</a></td>
                            <td>
                                <form action="{{route('admin.books.destroy', $book->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger" type="submit" value="حذف">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
