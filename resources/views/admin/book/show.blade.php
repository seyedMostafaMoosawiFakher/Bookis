@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if(session('success'))
                    <div class="col h3 text-success">{{session('success')}}</div>
                @endif
            </div>
            <div class="row text-center">
                <div class="card text-center mt-5">
                    <div class="card-header">
                          کتاب شماره:       {{$data['book']->id}}</div>
                    <div class="card-body">
                        <h4 class="card-title">{{$data['book']->name}}</h4>
                        <p class="card-text">{{$data['book']->description}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-info"> بازگشت : این دکمه را هندل کنم</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
