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
            'terms' =>  'required'
        ]);

        if(DB::table('epin')->where('epin', '=', $request->input('epin'))->where('status', 2)->where('alloted_to', Auth::user()->id)->count() > 0){
            if(Session::has('member_data') && !empty(Session::get('member_data'))) {
                $members = Session::get('member_data');
                $members['epin'] = $request->input('epin');
                $members['terms'] = $request->input('terms');
                $fullName = $members['full_name'];
                $email = $members['email'];
                $mobile = $members['mobile'];
                $sponsorID = $members['sponsorID'];
                $password = Hash::make($mobile);
                $gender = $members['gender'];
                $dob = $members['dob'];
                $status = 1;
                $epin = $members['epin'];
                $members['terms'] = $request->input('terms');
                $lag = $members['lag']; 

                if(isset($mobile) && !empty($mobile)){
                    if(!DB::table('members')->where('mobile', $mobile)->count() > 0){
                        $member_insert = DB::table('members')
                        ->insertGetId([
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
                            $generatedID = $this->memberIDGeneration($fullName, $member_insert);
                            $member_update = DB::table('members')
                            ->where('id', $member_insert)
                            ->update([
                                'member_id' =>  $generatedID,
                            ]);

                            try {
                                DB::transaction(function () use($sponsor_leg,$sponsor_node,$buyer_id,$total_node,$joining_level,$order_by) {});
                        }catch (\Exception $e) {
                              return redirect()->back()->with('error','Something Went Wrong Please try Again');
                    
                            }

                    }
                    else{
                        return redirect()->back()->with('error', 'Members is already registered!');
                    }
                }else{
                    return redirect()->back()->with('error', 'Mobile is required');
                }
                /*
                $member_insert = DB::table('members')
                ->insertGetId([
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
                    $generatedID = $this->memberIDGeneration($fullName, $member_insert);
                    $member_update = DB::table('members')
                    ->where('id', $member_insert)
                    ->update([
                        'member_id' =>  $generatedID,
                    ]);

               /* try {
                    DB::transaction(function () use($sponsor_leg,$sponsor_node,$buyer_id,$total_node,$joining_level,$order_by) {
                     }
            }catch (\Exception $e) {
                  return redirect()->back()->with('error','Something Went Wrong Please try Again');
        
                }

                return $generatedID;
                Session::put('member_data_epin', $members);
                Session::save();
                $token = rand(111111,999999);
                Session::put('terms_page_token', $token);
                Session::save();
                return redirect()->route('member.add_terms_form',['terms_page_token'=>encrypt($token)]);*/
            }
        }
        else{
            return redirect()->back()->with('error','EPIN is already been used! Try Different one!');
        }
    }
}

    public function termsSubmit(Request $request){
        $validatedData = $request->validate([
            'terms' => 'required',
        ]);

        if(Session::has('member_data_epin') && !empty(Session::get('member_data_epin'))) {
            $members = Session::get('member_data_epin');
            $fullName = $members['full_name'];
            // $generatedID = $this->memberIDGeneration($fullName);
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
                //    'member_id' =>  $generatedID,
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
                $generatedID = $this->memberIDGeneration($fullName, $member_insert);
                $member_update = DB::table('members')
                ->where('id', $member_insert)
                ->update([
                       'member_id' =>  $generatedID,
                ]);
                        // DB::table('tree')
                        // ->update([
                        //        'user_id' =>  Auth::user()->id,
                        //        'left_id' => $lag == 1 ? $member_insert : NULL,
                        //        'right_id' => $lag == 2 ? $member_insert : NULL,
                        //        'parent_id' => Auth::user ()->id,
                        //        'registered_by' => Auth::user()->id,
                        //        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        //    ]);
                        
                        // DB::table('epin')
                        // ->where('epin', $epin)
                        // ->update([
                        //        'status' => 1,
                        //        'used_by'    => $member_insert,
                        //        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        //    ]);

                        // $tree_insert =  DB::table('tree')
                        // ->insert([
                        //         'user_id' =>  $member_insert,
                        //         'parent_id' => Auth::user()->id,
                        //         'registered_by' => Auth::user()->id,
                        //         'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        //     ]);

                $token = rand(111111,999999);
                Session::put('product_page_token', $token);
                Session::save();
                return redirect()->route('member.product_page',['product_page_token'=>encrypt($token)]);
               }

        }

    }

    public function productPurchase(Request $request){
        $validatedData = $request->validate([
            'product' => 'required',
        ]);

    }

    function memberIDGeneration($fullName, $id){

        $splitName = explode(' ', $fullName, 3); 

        $first_name = $splitName[0];
        $last_name = $splitName[2];

        $title_id = $first_name[0].$last_name[0];
        $l_id = 6 - strlen((string)$id);
        $generatedID = $title_id ;
        for ($i=0; $i < $l_id; $i++) { 
            $generatedID .= "0";
        }
        $generatedID .= $id;
        return $generatedID;
    }

    function validateEPIN(Request $request){
        if($request->ajax()){
            $epin = $request->get('query');
            if(!empty($epin)) {
                $epin_data = DB::table('epin')->where('epin', $epin)->first();
                if($epin_data){
                    $epin_data_use_case = DB::table('epin')->where('epin', $epin)->where('status', 2)->first();
                    if($epin_data_use_case){
                        $epin_check_belong = DB::table('epin')->where('epin', $epin)->where('status', 2)->where('alloted_to', Auth::user()->id)->first();
                        if($epin_check_belong){
                            $member_data = DB::table('members')->where('id', $epin_data->alloted_to)->first();
                            if($member_data){
                                $output = '
                                    <input type="checkbox" name="terms" id="terms" value="1" required> 
                                    <a href="/add/terms/" target="_blank">I Agree Terms & Coditions</a>    
                                    <input type="submit" class="btn btn-primary pull-right" value="Next">
                                    ';
                                echo $output;
                            }
                            else{
                                return 1;
                            }
                        }
                        else{
                            return 5;
                        }
                    }
                    else{
                        return 3;
                    }
                }
                else{
                    return 2;
                }
            }
            else{
                return 5;
            }
        }
    }
}
