@extends('layers.parts.master')
@section('content')
<div class="container">
    <div class="col mt-5">
        <div class="row justify-content-center h3">
            <p> شماره موبایل ارسالی شما : {{$req}}</p>
        </div>
        <div class="row justify-content-center">
            <form action="{{route('auth.create')}}" method="post" class="row w-5 m-4" justify-content-center>
                @csrf
                <lable for="authString" class="row mt-5 mb-2 mr-2">
                    <p class="h4">لطفا کد ارسال شده در پیامک را وارد کنید.</p>
                </lable>
                <div class="row input-group">
                    <input class="form-control" name="otp"  style="border-top-right-radius: 0.90rem; border-bottom-right-radius: 0.90rem; border-bottom-left-radius: 0; border-top-left-radius: 0;" type="text" id="authString">
                    <div class="input-group-prepend order-1">
                        <button type="submit" class="input-group-prepend"  style="border-top-left-radius: 0.90rem; border-bottom-left-radius: 0.90rem;">go</button>
                    </div>
                </div>
                <input type="hidden" name="backUrl" value="{{URL::full()}}">
                <input name="mobile" hidden value="{{$req}}">
                <input name="realOtp" hidden value="{{$otp->otp}}">
                <input name="id" hidden value="{{$otp->id}}">
            @if($errors->any())
                    <div class="row mt-3">
                        @if($errors->has('auth'))
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="m-2">
                                        {{$error}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
            </form>
        </div>
        <p> sms : {{$otp->otp}}</p>
    </div>
</div>
@endsection
</body>
</html>
