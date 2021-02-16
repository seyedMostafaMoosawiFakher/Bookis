@extends('layers.parts.master')
@section('content')
<div class="container">
    <form action="{{route('auth.store')}}" method="post">
        @csrf
        <lable for="authString" class="row mt-5 mb-2 mr-2">
            <p>لطفا نام کاربری، ایمیل یا شماره موبایل خود را وارد کنید.</p>
        </lable>
        <div class="row input-group">
            <input class="form-control" name="auth"  style="border-top-right-radius: 0.90rem; border-bottom-right-radius: 0.90rem; border-bottom-left-radius: 0; border-top-left-radius: 0;" type="text" id="authString">
            <div class="input-group-prepend order-1">
                <button type="submit" class="input-group-prepend" style="border-top-left-radius: 0.90rem; border-bottom-left-radius: 0.90rem;">go</button>
            </div>
{{--            <button>go</button>--}}
        </div>
    </form>
</div>
@endsection
</body>
</html>
