<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use App\Model\ShoppingSlider;
use App\Model\ShoppingProduct;
class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function index()
    {
        $sliders = ShoppingSlider::limit(6)->get();
        $products = ShoppingProduct::where('status', 1)->limit(8)->get();
        return view('web.index', compact('sliders', 'products'));
    }

    public function registerForm()
    {
        return view('web.register');
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'first_name'   => 'required',
            'last_name' => 'required',
            'email'   => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        if($user->save()){
            return redirect('/web/login')->with('message', 'Successfully Registered!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong! Please Try Again');
        }
    }

    public function loginForm()
    {
        return view('web.login');
    }

    public function doLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password'   => 'required|min:6'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('web.index');
        }else{
            return redirect()->back()->with('error', 'Email or password is incorrect');
        }
    }
    
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('web.login');
    }
}
