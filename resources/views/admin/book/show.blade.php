@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row text-center justify-content-center">
                <div class="card text-center mt-5 w-75 ">
                    <div class="card-header">
                          کتاب شماره:       {{$data['book']->id}}</div>
                    <div class="card-body">
                        <h4 class="card-title">{{$data['book']->name}}</h4>
                        <p class="card-text">{{$data['book']->description}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-info" onclick = 'window.location.href = "{{route('admin.books.index')}}"'> بازگشت </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
