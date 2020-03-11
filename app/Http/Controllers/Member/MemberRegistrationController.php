<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;

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
            'full_name' => $fullName,
            'email' => $email,
            'mobile' => $mobile,
            'gender' => $gender,
            'dob' => $dob,
            'sponsorID' => $sponsorID,
            "lag" => $lag
        ];

        Session::put('member_data', $member_data);
        Session::save();
        $token = rand(111111,999999);
        Session::put('epin_page_token', $token);
        Session::save();
        return redirect()->route('member.add_epin_form',['epin_page_token'=>encrypt($token)]);
    }

    public function epinSubmit(Request $request){
        $validatedData = $request->validate([
            'epin' => 'required|exists:epin',
        ]);

        if(!DB::table('epin')->where('epin', '=', $request->input('epin'))->where('status', 1)->count() > 0){
            if(Session::has('member_data') && !empty(Session::get('member_data'))) {
                $members = Session::get('member_data');
                $members['epin'] = $request->input('epin');
                Session::put('member_data_epin', $members);
                Session::save();
                $token = rand(111111,999999);
                Session::put('terms_page_token', $token);
                Session::save();
                return redirect()->route('member.add_terms_form',['terms_page_token'=>encrypt($token)]);
            }
        }
        else{
            return redirect()->back()->with('error','EPIN is already been used! Try Different one!');
        }
    }

    public function termsSubmit(Request $request){
        $validatedData = $request->validate([
            'terms' => 'required',
        ]);

        if(Session::has('member_data_epin') && !empty(Session::get('member_data_epin'))) {
            $members = Session::get('member_data_epin');
            $fullName = $members['full_name'];
            $generatedID = $this->memberIDGeneration($fullName);
            $email = $members['email'];
            $password = Hash::make(123456);
            $mobile = $members['mobile'];
            $gender = $members['gender'];
            $dob = $members['dob'];
            $status = 1;
            $epin = $members['epin'];
            $members['terms'] = $request->input('terms');
            $lag = $members['lag'];
            
            $member_insert = DB::table('members')
            ->insertGetId([
                   'member_id' =>  $generatedID,
                   'name' => $fullName,
                   'email' => $email,
                   'password' => $password,
                   'mobile' => $mobile,
                   'gender' => $gender,
                   'dob' => $dob,
                   'status' => $status,
                   'epin' => $epin,
                   'policy_is_agree' => $members['terms'],
                   'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
               ]);

               if($member_insert){
                        DB::table('tree')
                        ->update([
                               'user_id' =>  Auth::user()->id,
                               'left_id' => $lag == 1 ? $member_insert : NULL,
                               'right_id' => $lag == 2 ? $member_insert : NULL,
                               'parent_id' => Auth::user()->id,
                               'registered_by' => Auth::user()->id,
                               'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                           ]);
                        
                        DB::table('epin')
                        ->where('epin', $epin)
                        ->update([
                               'status' => 1,
                               'used_by'    => $member_insert,
                               'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                           ]);

                        $tree_insert =  DB::table('tree')
                        ->insert([
                                'user_id' =>  $member_insert,
                                'parent_id' => Auth::user()->id,
                                'registered_by' => Auth::user()->id,
                                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                            ]);

                $token = rand(111111,999999);
                Session::put('product_page_token', $token);
                Session::save();
                return redirect()->route('member.product_page',['product_page_token'=>encrypt($token)]);
               }

        }

    }

    function memberIDGeneration($fullName){

        $splitName = explode(' ', $fullName, 3); 

        $first_name = $splitName[0];
        $last_name = $splitName[2];

        $title_id = $first_name[0].$last_name[0];
        
        $sql = DB::table('members')->select(DB::raw('max(substring(member_id, 8-LENGTH("'.$title_id.'"))) as max_val'))->get();
            foreach($sql as $row_data){
                $postfix =  $row_data->max_val;
            }
            $count = DB::table('members')->select(DB::raw('max(substring(member_id, 8-LENGTH("'.$title_id.'"))) as max_val'))->get()->count();
            if($count == 0){
                $title_id = $title_id.'000001';
            }
            else{
                $postfix = $postfix + 1;
                $addVal=str_pad($postfix, 8-strlen($title_id), '0', STR_PAD_LEFT);
                $title_id=$title_id.$addVal;
            }
        return $title_id;
    }
}
