@extends('parts.master')
@section('content')
<div class="container">
    <div class="col mt-5">
        <div class="row justify-content-center h3 text-center">
{{--            شماره موبایل را نمایش می دهیم--}}
            <p> <span class="text-danger">{{$req}}</span></p>
        </div>
{{--        دریافت کد اعتبار سنجی--}}
        <div class="row justify-content-center ">
            <form action="{{route('auth.store')}}" method="post" class="row w-5 m-4 text-center justify-content-center">
                @csrf
                <div class="col">
                    <lable for="password" class="row m-2 text-center justify-content-center">
                        <p class="h5 mb-3"><span class="text-danger">*</span> کلمه عبور </p>
                    </lable><input class="form-control" name="password" type="text" id="password" required>

                    <lable for="password2" class="row mt-3 text-center justify-content-center">
                        <p class="h5 mb-3"><span class="text-danger">*</span> تکرار کلمه عبور</p>
                    </lable><input class="form-control" name="password2" type="text" id="password2" required>

                    <lable for="authString" class="row mt-5 mb-2 mr-2 ml-2 text-center justify-content-center">
                        <p class="h5 mb-3">لطفا کد ارسال شده را وارد کنید.</p>
                    </lable>
                    <div class="row input-group">
                        <input class="form-control" name="otp"  style="border-top-right-radius: 0.90rem; border-bottom-right-radius: 0.90rem; border-bottom-left-radius: 0; border-top-left-radius: 0;" type="text" id="authString">
                        <div class="input-group-prepend order-1">
                            <button type="submit" class="input-group-prepend"  style="border-top-left-radius: 0.90rem; border-bottom-left-radius: 0.90rem;"> شروع </button>
                        </div>
                    </div>
    {{--                ادرس این صفحه برای برگشتن--}}
                    <input hidden name="backUrl" value="{{URL::full()}}">

    {{--آی دی سطری از او تی پی که ساختیم--}}
                    <input hidden name="otpId" value="{{$otpId}}">

    {{--                ولیدیشن ها را اعمال می کند--}}
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
            </div>
            </form>
        </div>
        <div class="row justify-content-center text-success">
{{--            اس ام اس ارسالی که به جای اس ام اس واقعی فیک کردیم--}}
            <p class="h6 text-info text-center"> sms : {{$otp->otp}}</p>
        </div>
    </div>
</div>
@endsection
</body>
</html>
