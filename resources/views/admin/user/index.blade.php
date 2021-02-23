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
            <a class="btn btn-primary w-75 my-2 " href="{{route('admin.users.create')}}"> ساخت کاربر جدید</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>شماره کاربر</th>
                        <th>نام کاربری</th>
                        <th>رمز عبور</th>
                        <th>ایمیل</th>
                        <th>شماره تلفن همراه</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['users'] as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->password}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile}}</td>
                            <td><a class="btn btn-secondary" href="{{route('admin.users.show', $user->id)}}">نمایش</a></td>
                            <td><a class="btn btn-success" href="{{route('admin.users.edit', $user->id)}}">ویرایش</a></td>
                            <td>
                                <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
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
        <div class="row justify-content-center my-5">
            {{$data['users']->links()}}
        </div>
    </div>
</div>

@endsection
