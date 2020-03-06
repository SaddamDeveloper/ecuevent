<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
class MemberRegistrationController extends Controller
{
    public function addNewMember(Request $request){
        $validatedData = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'dob' => 'required'
        ]);

        $sponsorID = $request->input('search_sponsor_id');
        $lag = $request->input('lag');
        $f_name = $request->input('f_name');
        $m_name = $request->input('m_name');
        $l_name = $request->input('l_name');
        $fullName = $f_name . " " . $m_name ." ". $l_name;
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');
        $dob = $request->input('dob');

        $member_data = [
            $sponsorID => [
                'full_name' => $fullName,
                'email' => $email,
                'mobile' => $mobile,
                'gender' => $gender,
                'dob' => $dob
            ],
            "lag" => $lag
        ];

        Session::put('member_data', $member_data);
        Session::save();
        $token = rand(111111,999999);
        Session::put('epin_page_token', $token);
        Session::save();
        return redirect()->route('member.add_epin_form',['epin_page_token'=>encrypt($token)]);
    }

    public function finalSubmit(Request $request){
        $validatedData = $request->validate([
            'epin' => 'required',
        ]);

        if(Session::has('member_data') && !empty(Session::get('member_data'))) {
            $members = Session::get('member_data');
            $member_data =[];
            
            if(count($member) > 0){
                foreach ($member as $member_id => $value) {
                    $members = DB::table('products')->where('id',$member_id)
                        ->whereNull('deleted_at')
                        ->where('status',1)
                        ->first();
                }
            }
        }
        else{
            $cart = false;
        }
    }
}
