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
        $sponsorVal = $request->input('sponsorVal');
        $lag = $request->input('lag');
        $f_name = $request->input('f_name');
        $m_name = $request->input('m_name');
        $l_name = $request->input('l_name');
        $fullName = $f_name . " " . $m_name ." ". $l_name;
        $email = $request->input('email');
        $mobile = $request->input('mobile');
        $gender = $request->input('gender');
        $dob = $request->input('dob');
        
        if($sponsorVal == 5){
            return redirect()->back()->with('error', 'All lags are full! Try with another Sponsor ID.');
        }
        else if($sponsorVal == 1){
            return redirect()->back()->with('error', 'Invalid Sponsor ID!');
        }
        else{
            if(DB::table('members')->where('mobile', $mobile)->count() < 1){
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
            else{
                return redirect()->back()->with('error', 'Mobile Number Exists.');
            }
        }
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

                try {
                    DB::transaction(function () use($members,$fullName,$email,$password,$mobile,$gender,$dob,$status,$epin, $lag) {
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

                    
                        $generatedID = $this->memberIDGeneration($fullName, $member_insert);
                        $member_update = DB::table('members')
                        ->where('id', $member_insert)
                        ->update([
                            'member_id' =>  $generatedID,
                            ]);
                            

                        //Fetch Member Data Using Sponsor ID
                        $fetch_member = DB::table('members')
                            ->where('member_id', $members['sponsorID'])
                            ->first();

                        //Fetch Tree Data Using User ID
                        $fetch_tree = DB::table('tree')
                            ->where('user_id', $fetch_member->id)
                            ->first();
                        
                        $tree_insert = DB::table('tree')
                        ->insertGetId([
                            'user_id' => $member_insert,
                            'parent_id' => $fetch_tree->id,
                            'registered_by' => Auth::user()->id,
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        ]);
                        if($lag == 1){
                            $tree_update = DB::table('tree')
                                ->where('id', $fetch_tree->id)
                                ->update([
                                    'left_id' => $tree_insert,
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString() 
                                ]);

                        }else{
                            $tree_update = DB::table('tree')
                                ->where('id', $fetch_tree->id)
                                ->update([
                                    'right_id' => $tree_insert ,
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString() 
                                ]);
                        
                        }
                        
                        //Update EPIN Table as Used
                        $epin_update = DB::table('epin')
                                ->where('epin', $epin)
                                ->update([
                                    'status' => 1
                                ]);
                        
                        //Insert Data in the Wallet for the first Time
                        $wallet_insert = DB::table('wallet')
                                    ->insertGetId([
                                        'user_id' =>    $member_insert,
                                        'amount' => 0,
                                        'status' => 1,
                                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                                    ]);
                                });
            
                $token = rand(111111,999999);
                Session::put('product_page_token', $token);
                Session::save();
                return redirect()->route('member.product_page',['product_page_token'=>encrypt($token), 'user_id'=>encrypt($member_insert)]);
                }catch (\Exception $e) {
                        return redirect()->back()->with('error','Something Went Wrong Please try Again');
            
                }
            } else{
                return redirect()->back()->with('error','EPIN is already been used! Try Different one!');
            }
        }
    }

    public function productPurchase(Request $request){
        $validatedData = $request->validate([
            'product' => 'required',
            'u_id' => 'required'
        ]);

        $product = $request->input('product');
        $image1 = $request->input('image1');
        $image2 = $request->input('image2');
        $productName = $request->input('productName');

        //EPIN Fetch
        
        //Insert Order to Databases
        $order_insert = DB::table('memlber_joining_order')
        ->insertGetId([
            'user_id' => $member_insert,
            'epin' => $epin,
            'product_name' => $productName,
            'image1' => $image1,
            'image1' => $image1,
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
        ]);
        // return $member_data['sponsorID'];

        $token = rand(111111,999999);
        Session::put('kyc_page_token', $token);
        Session::save();
        return redirect()->route('member.kyc_page',['kyc_page_token'=>encrypt($token)]);
    }
    

    function memberIDGeneration($fullName, $id){

        $splitName = explode(' ', trim($fullName), 3); 

        $first_name = trim($splitName[0]);
        $last_name = trim($splitName[2]);

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
