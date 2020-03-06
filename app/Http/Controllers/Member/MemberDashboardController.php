<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Contracts\Encryption\DecryptException;

class MemberDashboardController extends Controller
{
    public function index(){
        return view('member.dashboard');
    }

    public function profile(){
        return view('member.profile');
    }

    public function addNewMemberForm(){
        return view('member.registration.member_registration_form');
    }
    
    public function memberList(){
        return view('member.registration.member_list');
    }

    public function addEpinForm($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            // return redirect()->back();
            abort(404);
        }

        if (Session::has('epin_page_token') && !empty(Session::get('epin_page_token'))) {
            $session_token = Session::get('epin_page_token');
            if ( $session_token == $token) {
                return view('member.registration.add_epin_form');
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
       
    }
}
