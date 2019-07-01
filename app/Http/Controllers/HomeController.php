<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangeRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getSignOut()
    {
        Auth::logout();
        return \Redirect::to('/login');
    }

    public function getChangePassword()
    {
        return view('auth.passwords.change');
    }

    public function postChangePassword(ChangeRequest $request)
    {
        $hashPass = Auth::user()->password;
        if (Hash::check($request->password_old, $hashPass)) {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->password);
            $user->save();
            Auth::logout();
            return \Redirect::to('/login')
                ->with('status', 'Đổi mật khẩu thành công! Đăng nhập lại bằng mật khẩu mới!');
        } else {
            return redirect()->back()->with('error', 'Mật khẩu cũ sai!');
        }
    }

    public function information()
    {
        $user = Auth::user();
        return view('auth.information', compact('user'));
    }

    public function changeInformation()
    {
        $user = User::find(Auth::id());
        return view('auth.information', compact('user'));
    }

    public function postChangeInformation(UserRequest $request)
    {
        $user = User::find(Auth::id());
        $data = $request->all();
        if ($user->update($data)) {
            return redirect(route('information'))->with('status', 'sua thanh cong');
        } else {
            return redirect()->back()->with('error', 'loi');
        }
    }
}
