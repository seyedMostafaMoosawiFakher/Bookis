<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


/*
    the routes
|| metod    || rout            || rout name   || App\Http\Controllers\AuthController@index   | ---        |

| GET|HEAD  | auth             | auth.index   | App\Http\Controllers\AuthController@index   | web        |
| POST      | auth             | auth.store   | App\Http\Controllers\AuthController@store   | web        |
| POST      | auth/create      | auth.create  | App\Http\Controllers\AuthController@create  | web        |
| GET|HEAD  | auth/{auth}      | auth.show    | App\Http\Controllers\AuthController@show    | web        |
| PUT|PATCH | auth/{auth}      | auth.update  | App\Http\Controllers\AuthController@update  | web        |
| DELETE    | auth/{auth}      | auth.destroy | App\Http\Controllers\AuthController@destroy | web        |
| GET|HEAD  | auth/{auth}/edit | auth.edit    | App\Http\Controllers\AuthController@edit    | web        |

*/


class AuthController extends Controller
{

    public function index()
    {

        return view('auth.authenticate');
    }

    public function create(authRequest $request)
    {
        //شناخت نوع متن دریافتی

        $auth = $request->auth;

//        اگر رشته خالی باشد

        if($this->isEmpty($auth))
        {
            // رشته خالی است.

            return redirect($request->backUrl);
        }

//        اگر رشته موبایل باشد
        else if($this->isMobileNumber($auth))
        {
            // رشته شماره موبایل  است.

            //آیا شماره موبایل در او تی پی موجود است؟

            $haveOtp = Otp::where('mobile', $auth)->first('id');

            //اگر شماره موبایل موجود نیست پس رجیستر هم نیست.
            // با همین رجیستر نال، رجیستر شدن را هندل می کنیم.

            $registered = null;

            //اگر شماره موبایل موجود است رجیستر بودن را چک میکنیم.

            if($haveOtp!=null) {
                $registered = Otp::where('mobile', $auth)->where('otp', 'registered')->first('id');
            }
            //اگر او تی پی هست ولی رجیستر نشده یا کلا او تی پی نیست، ثبت نامش می کنیم.
            if($registered==null)
            {
                //ارسال کد اعتبار سنجی به کاربر در اس ام اس

                $realOtp = rand(4324,9234);

                // ایجاد یک سطر او تی پی حاوی ایدی و شماره اعتبار سنجی
                $otp = Otp::create([
                    'otp' => $realOtp,
                    'mobile' => $auth,
                ]);
                //ای دی سطر را به ویو می فرستیم تا به متد ستور ارسال شود و ولیدیت شود.
                $otpId = $otp->id;

                //                رشته اعلام شماره موبایل را می فرستیم

                $auth = "شماره موبایل شما: ". $auth;

                //رفتن به روت گرفتن کد اعتبار سنجی otp

                //در حقیقت فقط باید شماره موبایل و ای دی سطر را برای نمایش ببرد،
                // در اینجا اس ام اس نداریم کد اعتبار سنجی اصلی را هم برای استفاده به صورت فیک می فرستیم

                return view('auth.getOtpNumber', compact(['auth','otpId','otp']));
            }
            //اگر کاربر رجیستر کرده باشد
            else
            {
                //باید لاگین کنیم.

                // یوزر صاحب این سطر را پیدا می کنیم که همیشه یک نفر است
                $user = Otp::find($registered)->first()->user;


                // پسورد را می گیریم و چک می کنیم اگر درست بود لاگین می کنیم
                return view('auth.getPassword',compact('user'));

            }

        }

//        اگر رشته ایمیل باشد
        else if($this->isEmailAddress($auth))
        {
            //  رشته ایمیل  است.

            //آیا ایمیل در او تی پی موجود است؟

            $haveOtp = Otp::where('email', $auth)->first('id');

            //اگر ایمیل موجود است رجیستر بودن را چک میکنیم.
            // رجیسترد نال لازم است برای هندل کردن وقتی که اصلا او تی پی نداریم
            $registered = null;

            if($haveOtp!=null) {
                $registered = Otp::where('email', $auth)->where('otp', 'registered')->first('id');
            }

            if($registered==null)
            {
                //ارسال کد اعتبار سنجی به کاربر در ایمیل

                $realOtp = rand(4324,9234);

                // ایجاد یک سطر او تی پی حاوی ایدی و شماره اعتبار سنجی
                $otp = Otp::create([
                    'email' => $auth,
                    'otp' => $realOtp,
                ]);

                //ای دی سطر را می فرستیم تا به متد ستور ارسال  شود.
                $otpId = $otp->id;

                //                رشته اعلام شماره موبایل را می فرستیم

                $auth = "ایمیل شما: ". $auth;

                //رفتن به روت گرفتن کد اعتبار سنجی otp

                //در حقیقت فقط باید ایمیل و ای دی سطر را برای نمایش ببرد،

                return view('auth.getOtpNumber', compact(['auth','otpId','otp']));
            }

            //اگر کاربر قبلا رجیستر کرده باشد
            else {
                //باید لاگین کنیم.

                // یوزر صاحب این سطر را پیدا می کنیم که همیشه یک نفر است
                $user = Otp::find($registered)->first()->user;

                // پسورد را می گیریم و چک می کنیم اگر درست بود لاگین می کنیم
                return view('auth.getPassword', compact('user'));
            }

        }

// اگر رشته ایمیل یا شماره موبایل نیست..
//(در جایی که رکوئست رولز کار نکند یا هک شود به اینجا می رسیم.)
        else
        {
            // رشته ایمیل یا شماره موبایل نیست..

            //            با الرت به کاربر نشان می دهیم
            return redirect($request->backUrl);
        }

    }

    public function store(Request $request)
    {
//        پسورد را هندل کنم
//اگر دو پسورد مطابقت ندارند
        if($request->password!=$request->password2){

//            سویت آلرت

            return redirect()->route('home.index');
        }
//        اگر دو پسورد مطابقت دارند
        else{
            //پسورد را تعریف و مقدار دهی می کنیم

            $password = $request->password;

            //        گرفتن ای دی سطری که ساخته ایم و پیدا کردن سطر
            $otpId = $request->otpId;

            //        پیدا کردن کد اعتبار سنجی درون سطر آن سطر از او تی پی
            $otpRow = Otp::where('id',$otpId)->first();

            //        گرفتن کد اعتبار سنجی

            $realOtp = $otpRow->otp;

            // گرفتن شماره موبایل یا ایمیل

            $mobile = $otpRow->mobile;
            $email = $otpRow->email;

            // گرفتن زمان کریتد ات
            $otpCreatedAt = $otpRow->created_at;

            //چک می کنیم که بیش از یک دقیقه از ساخت سطر نگذشته باشد

            //        اضافه کردن یک دقیقه به زمان ساخت او تی پی
    //        در اینجا دیگر زمان ساخت در دسترس نیست. چون متد اد مینیت انرا تغییر می دهد و سپس درون مکس قرار می دهد
            $maxOtpTime = $otpCreatedAt->addMinutes(1);

            //        گرفتن زمان حال
            $currentDate = Carbon::now();

    //        چک می کنیم کد ارسالی کاربر مساوی کد ارسال شده از سطر او تی پی هست یا نه
    //و چک میکنیم زمان  حال کوچکتر یا مساوی زمان ساخت او تی پی به اضافه یک دقیقه باشد.
            if($realOtp==$request->otp&&$currentDate<=$maxOtpTime)
            {
                //یوزر را می سازیم
                $user = User::create([
                    'mobile'=>$mobile,
                    'email'=>$email,
                    'password'=>$password,
                ]);

                //حالا آی دی یوزر را می گیریم
                $userId =$user->id;

    //آی دی و شماره موبایل و... را درون ستون یوزر ای دی و موبایل و... جدول او تی پی قرار می دهیم.
    //            او تی پی را به رجیسترد تغییر می دهیم تا بدانیم کاربر ثبت نام کرده.
                $otpRow->update([
                    'password' => $password,
                    'email' => $email,
                    'mobile' => $mobile,
                    'user_id' => $userId,
                    'otp' => "registered"
                ]);

                // لاگین هم می کنیم

                Auth::login($user);

                // بازگشت به صفحه اصلی سایت

                return redirect()->route('home.index');
            }
    //اگر وقت تمام شده بود یا شماره وارد شده درست نبود.
            else
            {
    //آلرت می دهیم:
                dd('کد تایید درست وارد نشده یا بیش از یک دقیقه منتظر ماندید.');
                return redirect()->route('auth.index');
            }
        }
    }

    // چک کردن درست بودن پسورد دریافتی با پسورد یوزر و لاگین

    public function login ($user, Request $request)
    {
        //        پسورد حقیقی یوزر را از جدول یوزرز می گریم
        $realPassword = User::find($user)->password;

        //پسوردی که الان کاربر برای لاگین زده را می گیریم
        $currentPassword = $request->password;

        //اگر پسورد وارد شده با پسورد اصلی مطابق بود لاگین می کنیم و در جدول او تی پی سیو می کنیم.

        if($realPassword==$currentPassword)
        {
        //            یوزر را می گیریم
        $user = User::find($user);

        // لاگین می کنیم.
        Auth::login($user);

        //باید یک سطر او تی پی با او تی پی لاگیند اضافه کنیم

        Otp::create([
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'mobile' => $user->mobile,
            'otp' => 'logined',
            'user_id' => $user->id,
        ]);

            //  به صفحه اصلی می فرستیم.
            return redirect()->route('home.index');

        }
//        اگر پسورد اشتباه بود
        else
        {

        //            یک الرت می دهیم

        //  به صفحه اصلی می فرستیم.
        return redirect()->route('home.index');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }







    //آیا رشته خالی است؟
    private function isEmpty ($request)
    {
        //آیا رشته خالی است؟
        $isEmpty = empty($request);

        return $isEmpty;
    }

    //    آیا رشته شماره موبایل است؟
    private function isMobileNumber ($request)
    {
        //            آیا شماره موبایل است؟
        if($this->isNumber($request)&&$this->isMobileLenght($request)&&$this->isIranianMobile($request))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function isNumber ($request)
    {
        // آیا رشته عدد است؟

        $isNumber = is_numeric($request);

        return $isNumber;
    }

    public function isMobileLenght ($request)
    {
        //         آیا طول رشته به اندازه شماره موبایل است؟

        $l = strlen($request);
        if($l===11)
        {
            $mobileLenght=true;
        }
        else
        {
            $mobileLenght=false;
        }

        return $mobileLenght;
    }

    private function isIranianMobile ($request)
    {
        //         آیا  رشته با 09 شروع شده است؟

        $isIranianMobile = strpos($request, '09');
        if($isIranianMobile===false||$isIranianMobile!=0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //آیا رشته ایمیل است؟
    public function isEmailAddress ($request)
    {
        //            آیا استرینگ ایمیل است؟

        if($this->haveAtsine($request)&&$this->oneAtsine($request)&&$this->haveDote($request)&&$this->haveOneDoteAfterAtsine($request))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function haveAtsine ($request)
    {
        //  ایا رشته @ دارد؟

        $haveAtsine = strpos($request , '@');

        if($haveAtsine===false)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public function oneAtsine ($request)
    {
        //  آیا رشته بیش از یک @ دارد؟

        $arr = explode('@',$request);
        $oneAtsine = count($arr)-1;

        return $oneAtsine;

    }

    public function haveDote ($request)
    {
        //  آیا رشته نقطه دارد؟

        $haveDote = strpos($request , '.');

        if($haveDote===false)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    public function haveOneDoteAfterAtsine ($request)
    {
        //ایا بعد از @ یک نقطه داریم؟

        $arr = explode('@',$request);
        if(count($arr)>1)
        {
            $afterAtsine = $arr[1];
            $arrayLenght = explode('.',$afterAtsine);
            $manyDotesAfterAtsine = count($arrayLenght)-2;
            if($manyDotesAfterAtsine==0)
            {
                $haveOneDoteAfterAtsine = 1;
            }
            else
            {
                $haveOneDoteAfterAtsine = 0;
            }
        }
        else
        {
            $haveOneDoteAfterAtsine = 0;
        }
        return $haveOneDoteAfterAtsine;
    }


    public function logout($user){
        Auth::logout($user);

        return redirect()->route('home.index');
    }

}

