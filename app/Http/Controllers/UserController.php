<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/*
    the routes
|| metod    || rout            || rout name   || App\Http\Controllers\AuthController@index   | web        |

| GET|HEAD  | user             | user.index   | App\Http\Controllers\UserController@index   | web        |
| POST      | user             | user.store   | App\Http\Controllers\UserController@store   | web        |
| GET|HEAD  | user/create      | user.create  | App\Http\Controllers\UserController@create  | web        |
| GET|HEAD  | user/{user}      | user.show    | App\Http\Controllers\UserController@show    | web        |
| PUT|PATCH | user/{user}      | user.update  | App\Http\Controllers\UserController@update  | web        |
| DELETE    | user/{user}      | user.destroy | App\Http\Controllers\UserController@destroy | web        |
| GET|HEAD  | user/{user}/edit | user.edit    | App\Http\Controllers\UserController@edit    | web        |
*/

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        route = http://localhost:8000/user
//        route name = user.index
//        route metod = get|head

        $users = User::all();

//بعدا پیجینیت می شود.//
//        $users = User::latest()->paginate(12);

        return view('layers.users', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        route = http://localhost:8000/user/create
//        route name = user.create
//        route metod = get|head

//        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
//        route = http://localhost:8000/user
//        route name = user.store
//        route metod = post

        $user = User::create([]);

        //validation

//        $request->validate([
//            'title' => 'required',
//            'body' => 'required'
//            'email' =>'required|email|unique:users',
//        ]);

        //create user

//        User::create([
//            'title' => $request->title,
//            'body' => $request->body,
//            'status' => 1,
//            'user_id' => $request->user_id,
//        ]);

//        return redirect()->route('index');

        return 'user namber ' . $user->id . ' created';
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
//        route = http://localhost:8000/user/{user}
//        route name = user.show
//        route metod = get|head

        return 'the user id is ' . $user->id;

//        return view('user', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
//        route = http://localhost:8000/user/{user}/edit
//        route name = user.edit
//        route metod = get|head
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        route = http://localhost:8000/user/{user}
//        route name = user.update
//        route metod = put|patch

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
//        route = http://localhost:8000/user/{user}
//        route name = user.destroy
//        route metod = delete

        $message = 'the user namber '. $user->id . ' deletes';

        $user->delete();

//        return $message;
        return redirect()->route('index');

    }
}


//        $master = Role::create(['name' => 'master']);
//        $writer = Role::create(['name' => 'writer']);
//        $member = Role::create(['name' => 'member']);
//        $user->assignRole('master');

