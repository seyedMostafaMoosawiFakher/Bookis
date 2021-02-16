<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //swich for find type (number, email,userName)

        $r = $request->auth;
        $r = trim($r);

        //1آیا رشته خالی است؟

        $empty = empty($r);

        //2 آیا رشته عدد است؟
        $isNumber = is_numeric($r);

        //         آیا طول رشته به اندازه شماره موبایل است؟
        $l = strlen($r);
        if($l==11){$mobileNumber=1;}else{$mobileNumber=0;};

         //3 آیا رشته ایمیل است؟

        // الف ایا رشته @ دارد؟
        $haveAtsine = strpos($r , '@');


        // ب آیا رشته بیش از یک @ دارد؟
        $arr = explode('@',$r);
        $oneAtsine = count($arr)-1;

        // ج آیا رشته نقطه دارد؟
        $haveDote = strpos($r , '.');


        //ایا بعد از @ یک نقطه داریم؟
//        $arr = explode('@',$r);
        if(count($arr)>1){
        $afterAtsine = $arr[1];
        $arrayLenght = explode('.',$afterAtsine);
        $manyDotesAfterAtsine = count($arrayLenght)-2;
            if($manyDotesAfterAtsine==0)
            {
                $haveOneDoteAfterAtsine = 1;
            }else
            {
                $haveOneDoteAfterAtsine = 0;
            }
        }else
        {
            $haveOneDoteAfterAtsine = 0;
        }

//dd($r, $isNumber, $mobileNumber,$haveAtsine,$oneAtsine,$haveDote,$haveOneDoteAfterAtsine);

        if(empty($r)){
            echo('رشته خالی است.');
        }else if($isNumber&&$mobileNumber){
            echo('رشته شماره موبایل  است.');
        }else if($haveAtsine&&$oneAtsine&&$haveDote&&$haveOneDoteAfterAtsine){
            echo('رشته ایمیل  است.');
        }else{
            echo('رشته یوزر نیم است.');
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
}
