<?php

namespace App\Http\Controllers;

use App\Http\Requests\authRequest;
use Illuminate\Http\Request;


/*
    the routes
|| metod    || rout            || rout name   || App\Http\Controllers\AuthController@index   | ---        |

| GET|HEAD  | auth             | auth.index   | App\Http\Controllers\AuthController@index   | web        |
| POST      | auth             | auth.store   | App\Http\Controllers\AuthController@store   | web        |
| GET|HEAD  | auth/create      | auth.create  | App\Http\Controllers\AuthController@create  | web        |
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(authRequest $request)
    {
        //شناخت نوع متن دریافتی

        $request = trim($request->auth);


        if($this->isEmpty($request))
        {
            echo('رشته خالی است.');
        }
        else if($this->isMobileNumber($request))
        {
            echo('رشته شماره موبایل  است.');
        }
        else if($this->isEmailAddress($request))
        {
            echo('رشته ایمیل  است.');
        }
        else
        {
            echo('رشته ایمیل یا شماره موبایل نیست..');
        }




        //if existes : login

        //else : register



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

