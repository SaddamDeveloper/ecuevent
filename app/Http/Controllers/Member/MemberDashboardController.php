<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
