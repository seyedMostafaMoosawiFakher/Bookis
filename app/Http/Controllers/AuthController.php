<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layers.authenticate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function create(authRequest $request)
    {
        //شناخت نوع متن دریافتی

        $req = trim($request->auth);


        if($this->isEmpty($req))
        {
            // رشته خالی است.

            return redirect($request->backUrl);
        }
        else if($this->isMobileNumber($req))
        {
            // رشته شماره موبایل  است.

            //آیا شماره موبایل در او تی پی موجود است؟

            $haveOtp = Otp::where('mobile', $req)->first('id');

            //اگر شماره موبایل موجود است رجیستر بودن را چک میکنیم.
            // رجیسترد نال لازم است برای هندل کردن وقتی که اصلا او تی پی نداریم
            $registered = null;
//dd($haveOtp->id,$req);
            if($haveOtp!=null) {
                $registered = Otp::where('mobile', $req)->where('otp', 'registered')->first('id');
            }

            if($registered==null)
            {
                //ارسال کد اعتبار سنجی به کاربر در اس ام اس

                $realOtp = rand(4324,9234);

                // ایجاد یک سطر او تی پی حاوی ایدی و شماره اعتبار سنجی
                $otp = Otp::create([
                    'otp' => $realOtp,
                ]);
//ای دی سطر را می فرستیم تا به متد ستور ارسال شود و ولیدیت شود.
                $otpId = $otp->id;
                //رفتن به روت گرفتن کد اعتبار سنجی otp

                //در حقیقت فقط باید شماره موبایل و ای دی سطر را برای نمایش ببرد،
                // در اینجا اس ام اس نداریم کد اعتبار سنجی اصلی را هم برای زدن می فرستیم

                return view('layers.getOtpNumber', compact(['req','otpId','otp']));
            }
            else
                {
                //باید لاگین کنیم.
                    dd("user");
                }

        }
        else if($this->isEmailAddress($req))
        {
            //  رشته ایمیل  است.

//            User::create([
//                'email' => $req,
//            ]);
        }
        else
        {
            // رشته ایمیل یا شماره موبایل نیست..

            return redirect($request->backUrl);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        گرفتن ای دی سطری که ساخته ایم و پیدا کردن سطر
        $otpId = $request->otpId;

        //        پیدا کردن کد اعتبار سنجیی درون سطر آن سطر از او تی پی
        $otpRow = Otp::where('id',$otpId)->first();

        //        گرفتن کد اعتبار سنجی و زمان کریتدات

        $realOtp = $otpRow->otp;
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
            $user = User::create(['mobile'=>$request->mobile]);

            //حالا آی دی یوزر را می گیریم
            $userId =$user->id;

//آی دی و شماره موبایل را درون ستون یوزر ای دی و موبایل جدول او تی پی قرار می دهیم.
//            او تی پی را به رجیسترد تغییر می دهیم تا بدانیم کاربر ثبت نام کرده.
            $otpRow->update([
                'mobile' => $request->mobile,
                'user_id' => $userId,
                'otp' => "registered"
            ]);

// بازگشت به صفحه اصلی سایت
            return redirect()->route('home.index');
        }
        else
        {
//اگر وقت تمام شده بود یا شماره وارد شده درست نبود.
//آلرت می دهیم:
            dd('کد تایید درست وارد نشده یا بیش از یک دقیقه منتظر ماندید.');
            return redirect()->route('auth.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

}

