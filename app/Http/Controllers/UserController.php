<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

//my
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

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
        $user = User::create([]);

        //validation

//        $request->validate([
//            'title' => 'required',
//            'body' => 'required'
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
        $message = 'the user namber '. $user->id . ' deletes';

        $user->delete();

        return $message;

    }
}


//        $master = Role::create(['name' => 'master']);
//        $writer = Role::create(['name' => 'writer']);
//        $member = Role::create(['name' => 'member']);
//        $user->assignRole('master');

