<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:member')->except('logout');
    }

    public function showMemberLoginForm(){
        return view('member.index', ['url' => 'member']);
    }

    public function memberLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('member')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/member/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Email or password is incorrect');
    }

    public function logout()
    {
        Auth::guard('member')->logout();
        return redirect()->route('member.login');
    }
}
