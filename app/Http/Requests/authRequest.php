<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class authRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'auth' => [
                'required',
                'min:5',
                'max:50',

//گرفتن استرینگی که بتواند ایمیل شماره موبایل یا یوزر نیم باشد را نتوانستم هندل کنم!!!!
//                'alpha_num'or'email'

//            آیا متنی وارد شده است؟
//                function($attribute, $value, $fail){
//
//                    if($this->isEmpty($value))
//                    {
//                        $fail('The '.$attribute.' is empty.');
//                    }
//            },

        //            آیا متن وارد شده یک شماره موبایل یا ایمیل معتبر است؟
                function($attribute, $value, $fail){
                    if(!($this->isMobileNumber($value)||$this->isEmailAddress($value)))
                    {
                        $fail('The '.$attribute.' is not a current mobile number or email.');
                    }
            },

        //            آیا متن وارد شده یک شماره موبایل معتبر است؟
//                function($attribute, $value, $fail) {
//                    if (!$this->isMobileNumber($value)) {
//                        $fail('The ' . $attribute . ' is not a current mobile number.');
//                    }
//                },

        //            },        //            آیا متن وارد شده یک ایمیل است؟
//                function($attribute, $value, $fail){
//                    if(!$this->isEmailAddress($value))
//                    {
//                        $fail('The '.$attribute.' is not  email address.');
//                    }
//            },

//    کار نکرد:        برای هندل اینکه استرینگ هم بتواند عدد باشد و هم حروف و هم ایمیل

        //            آیا متن وارد شده یک استرینگ درست است؟
//                function($attribute, $value, $fail){
//                    if(!$this->isTrueString($value))
//                    {
//                        $fail('The '.$attribute.' is not  true user name.');
//                    }
//            },

            ]
        ];
    }

    //آیا رشته خالی است؟

    //    private function isEmpty ($request)
//    {
//        //آیا رشته خالی است؟
//
//        $isEmpty = empty($request);
//
//        return $isEmpty;
//    }

    //    آیا رشته شماره موبایل است؟
    private function isMobileNumber ($request)
    {

//        dd($this->isNumber($request),$this->isMobileLenght($request),$this->isIranianMobile($request));
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

        private function isNumber ($request)
        {
            // آیا رشته عدد است؟

            $isNumber = is_numeric($request);

            return $isNumber;
        }

        private function isMobileLenght ($request)
        {
            //         آیا طول رشته به اندازه شماره موبایل است؟

            $l = strlen($request);
            if($l==11)
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
    private function isEmailAddress ($request)
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

        private function haveAtsine ($request)
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

        private function oneAtsine ($request)
        {
            //  آیا رشته بیش از یک @ دارد؟

            $arr = explode('@',$request);
            $oneAtsine = count($arr)-1;

            return $oneAtsine;

        }

        private function haveDote ($request)
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

        private function haveOneDoteAfterAtsine ($request)
    {
        //ایا بعد از @ یک نقطه داریم؟

        $arr = explode('@',$request);
        if(count($arr)>1)
        {
            $afterAtsine = $arr[1];
            $arrayLenght = explode('.',$afterAtsine);
            $haveMuchDotesAfterAtsine = count($arrayLenght)-2;
            if($haveMuchDotesAfterAtsine==0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

//فانکشن درون کلوژر بالا که مربوط است به: هندل استرینگ ایمیل نمریک که نشد

        //    private function isTrueString ($request)
//    {
//        کارکترهایی که می توانند درون استرینگ باشند:
//کار نکرد
//        $uppercase = preg_match('@[A-Z]@', $request);
//        $lowercase = preg_match('@[a-z]@', $request);
//        $number    = preg_match('@[0-9]@', $request);
//
//        if(!$uppercase || !$lowercase || !$number)
//        {
//            return  false;
//        }
//        else
//        {
//            return true;
//        }
//کار نکرد
//        if (preg_match("[^a-zA-Z0-9-_@.]",$request))
//        {
//            return true;
//        }
//        else
//        {
//            return false;
//
//        }
//    }

}
