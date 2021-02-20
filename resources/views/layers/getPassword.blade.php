@extends('layers.parts.master')
@section('content')
<div class="container">
    <div class="col">
        <div class="row justify-content-center mt-5">
            <form action="{{route('auth.login',$user)}}" method="post" class="row justify-content-center">
              @csrf
                <lable for="password" class="row mb-3 text-center">
                    <p class="h5 text-success"><span class="text-danger">*</span> پسورد را وارد نمایید: </p>
                </lable>
                <div class="row input-group">
                    <input class="form-control " name="password"  style="border-top-right-radius: 0.90rem; border-bottom-right-radius: 0.90rem; border-bottom-left-radius: 0; border-top-left-radius: 0;" type="text" id="password">
                    <div class="input-group-prepend order-1 ">
                        <button type="submit" class="input-group-prepend"  style="border-top-left-radius: 0.90rem; border-bottom-left-radius: 0.90rem;"> مرحله بعدی </button>
                    </div>
                </div>
{{--                برای وقتی که رشته خالی فرستاده و ولیدیشن رکوئست سفارشی را غیر فعال کردیم(یا هک شد)--}}
                <input type="hidden" name="backUrl" value="{{URL::full()}}">
{{--   نشان دادن ارورهای ولیدیشن فرم رکوئست--}}
            @if($errors->any())
                <div class="col">
                    <div class="row mt-3 text-right">
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
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
</body>
</html>
