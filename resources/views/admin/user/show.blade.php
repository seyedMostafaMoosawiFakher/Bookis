@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="col">
            <div class="row text-center justify-content-center">
                <div class="card text-center mt-5 w-75 ">
                    <div class="card-header">
                          یوزر شماره:       {{$data['user']->id}}</div>
                    <div class="card-body">
                        <h4 class="card-title">{{$data['user']->username}}</h4>
                        <p class="card-text">{{$data['user']->password}}</p>
                        <p class="card-text">{{$data['user']->email}}</p>
                        <p class="card-text">{{$data['user']->mobile}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-info" onclick = 'window.location.href = "{{route('admin.users.index')}}"'> بازگشت </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
