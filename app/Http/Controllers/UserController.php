<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/*
    the routes
|| metod    || rout                      || rout name

|| GET|HEAD  | admin/users               | admin.users.index
|| POST      | admin/users               | admin.users.store
|| GET|HEAD  | admin/users/create        | admin.users.create
|| PUT|PATCH | admin/users/{user}        | admin.users.update
|| DELETE    | admin/users/{user}        | admin.users.destroy
|| GET|HEAD  | admin/users/{user}        | admin.users.show
|| GET|HEAD  | admin/users/{user}/edit   | admin.users.edit
*/

class UserController extends Controller
{

    public function index()
    {
        $data['users'] = User::latest()->paginate(5);

        return view('admin.user.index', compact('data'));
    }

    public function create()
    {
        return view('admin.user.create');

    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
           'username' => 'required',
           'password' => 'string',
           'email' => 'email',
           'mobile' => 'numeric'
        ]);

        User::create($attributes);

        return redirect()->action([self::class, 'index'])->with(['success' => 'کاربر جدید با موفقیت ایجاد شد']);
    }

    public function show(User $user)
    {
//        $users = User::has('profile')->get();
//        dd($users);


        $data['user'] = $user;

        return view('admin.user.show', compact('data'));
    }

    public function edit(User $user)
    {
        $data['user'] = $user;

        return view('admin.user.edit', compact('data'));
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'username' => 'required',
            'password' => 'string',
            'email' => 'email',
            'mobile' => 'numeric'
        ]);

        $user->username = $attributes['username'];
        $user->password = $attributes['password'];
        $user->email = $attributes['email'];
        $user->mobile = $attributes['mobile'];

        $user->save();

        return redirect()->action([self::class, 'index'])->with(['success' => 'مشخصات کاربر با موفقیت ویرایش شدند']);
    }

    public function destroy(User $user)
    {
        $message = 'یوزر شماره '. $user->id . ' با موفقیت حذف شد.';
        $user->delete();

        return redirect()->action([self::class, 'index'])->with(['success' => $message]);
    }

}


