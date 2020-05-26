<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;
use Hash;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;

class MemberRegistrationController extends Controller
{
    public function addNewMember(Request $request){
        $validatedData = $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'mobile' => 'required|numeric:10',
            'gender' => 'required',
            'dob' => 'required',
            'relation' => 'required',
            'n_name' => 'required',
            'n_mobile' => 'required|numeric:10',
            'n_address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required|numeric'
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

        // Nominee Details
        $relation = $request->input('relation');
        $n_name = $request->input('n_name');
        $n_mobile = $request->input('n_mobile');
        $n_address = $request->input('n_address');
        $state = $request->input('state');
        $city = $request->input('city');
        $pin = $request->input('pin');
        
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
                    'lag' => $lag,
                    'relation' => $relation,
                    'n_name' => $n_name,
                    'n_mobile' => $n_mobile,
                    'n_address' => $n_address,
                    'state' => $state,
                    'city' => $city,
                    'pin' => $pin
                ];

                Session::put('member_data', $member_data);
                Session::save();
                $token = rand(111111,999999);
                Session::put('epin_page_token', $token);
                Session::save();
                return redirect()->route('member.add_epin_form',['epin_page_token'=>encrypt($token)]);
    
            }
            else{
                return redirect()->back()->with('error', 'Mobile number exists!');
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
                $relation = $members['relation'];
                $n_name = $members['n_name'];
                $n_mobile = $members['n_mobile'];
                $n_address = $members['n_address'];
                $state = $members['state'];
                $city = $members['city'];
                $pin = $members['pin'];
                $registered_by = Auth::user()->name;
                try {
                    DB::transaction(function () use($members,$fullName,$email,$password,$mobile,$gender,$dob,$status,$epin,$lag,$relation,$n_name,$n_mobile,$n_address,$state,$city,$pin,$registered_by,&$member_insert) {
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
                            'nominee_relation' => $relation,
                            'nominee_name' => $n_name,
                            'nominee_mobile' => $n_mobile,
                            'nominee_address' => $n_address,
                            'state' => $state,
                            'city' => $city,
                            'pin' => $pin,
                            'order_status' => 1,
                            'policy_is_agree' => $members['terms'],
                            'registered_by' => $registered_by,
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
                                    'parent_leg' => 'L',
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString() 
                                ]);

                        }else{
                            $tree_update = DB::table('tree')
                                ->where('id', $fetch_tree->id)
                                ->update([
                                    'right_id' => $tree_insert ,
                                    'parent_leg' => 'R',
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString() 
                                ]);
                        
                        }
                        
                        //Update EPIN Table as Used
                        $epin_update = DB::table('epin')
                                ->where('epin', $epin)
                                ->update([
                                    'status' => 1,
                                    'used_by' => $member_insert
                                ]);
                        
                        //Insert Data in the Wallet for the first Time
                        $wallet_insert = DB::table('wallet')
                                ->insertGetId([
                                    'user_id' => $member_insert,
                                    'amount' => 0,
                                    'status' => 1,
                                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                                ]);

                        // Fetch All Parent of Current Registered node

                        $parrents = DB::select( DB::raw("SELECT * FROM (
                            SELECT @pv:=(
                                SELECT parent_id FROM tree WHERE id = @pv
                                ) AS lv FROM tree
                                JOIN
                                (SELECT @pv:=:start_node) tmp
                            ) a
                            WHERE lv IS NOT NULL AND lv != 0 LIMIT 1000")
                            , array(
                              'start_node' => $tree_insert,
                            )
                        );
                        $a = $this->treePair($parrents, $member_insert);
                    });
                    
                        // $delete_previous_session = session()->forget('member_data');
                        // $delete_epin_session = session()->forget('epin_page_token');
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
            
        $u_id = $request->input('u_id');
        $product_id = $request->input('product');
        // return $u_id;
        //EPIN Fetch
        $epin_fetch = DB::table('epin')->where('used_by', $u_id)->first();
        // dd($epin_fetch);
        $epin = $epin_fetch->epin;
        if($epin_fetch){

            // Product Fetch
            $product_fetch = DB::table('member_product')->where('id', $product_id)->first();
            $productName = $product_fetch->name;
            $image1 = $product_fetch->image1;
            $image2 = $product_fetch->image2;
            
            if($product_fetch){
                //Insert Order to Databases
                $order_insert = DB::table('member_joining_order')
                ->insertGetId([
                    'user_id' => $u_id,
                    'epin' => $epin,
                    'product_name' => $productName,
                    'image1' => $image1,
                    'image1' => $image1,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);

                if($order_insert){
                    $delete_previous_session = session()->forget('product_page_token');
                    $token = rand(111111,999999);
                    Session::put('kyc_page_token', $token);
                    Session::save();
                    return redirect()->route('member.kyc_page',['kyc_page_token'=>encrypt($token), 'user_id' => encrypt($u_id)]);
                }else{
                    return redirect()->back()->with('error', 'Something went wrong!');
                }

            }else{
                return redirect()->back()->with('error', 'Oops! No Product Found!');
            }

        }else{
            return redirect()->back()->with('error', 'Ooops! No EPIN Found!');
        }

    }

    public function kycSubmit(Request $request){

        $validatedData = $request->validate([
            'u_id' => 'required',
            'address' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'doc' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
        
        $u_id = $request->input('u_id');
        $docNo = $request->input('doc');
        $address = null;
        $photo = null;
        
        if($request->hasfile('address'))
        {
            $address_array = $request->file('address');
            $address = $this->imageInsert($address_array, $request, 1);
        }
        if($request->hasfile('photo'))
        {
            $photo_array = $request->file('photo');
            $photo = $this->imageInsert($photo_array, $request, 2);
        }

        $member_fetch = DB::table('members')->where('id', $u_id)->first();
        if($member_fetch){
            $kyc_update = DB::table('members')
                ->where('id', $member_fetch->id)
                ->update([
                    'address_proof_doc' => $address,
                    'address_proof_no' => $docNo,
                    'photo_proof' => $photo,
                    'document_status' => 2,
                    'document_u_status'  => 1,
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $delete_previous_session = session()->forget('kyc_page_token');
            $token = rand(111111,999999);
            Session::put('finish_page_token', $token);
            Session::save();
            return redirect()->route('member.finish_page',['finish_page_token'=>encrypt($token)]);

        }else{
            return redirect()->back()->with('error', 'Something Went wrong!');
        }
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

    function imageInsert($image, Request $request, $flag){

        $destination = base_path().'/public/member/ID/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time()).$flag.".".$image_extension;
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/member/ID/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);

        return $image_name;
    }


    function treePair($parents, $member_insert){
        $child = $member_insert;
       
        for ($i=0; $i < count($parents) ; $i++) {
            $parent = $parents[$i]->lv; 

            //**************Fetch parrent details***************************
            $fetch_parent = DB::table('tree')
                ->select('left_id', 'right_id')
                ->where('id',$parent)
                ->first();

            //***************check chield node is in left or right*******************
            if ($fetch_parent->left_id == $child){
                //Check Left count already had previous value + 1
                $update_left_count = DB::table('tree')
                ->where('id', $parent)
                ->update([
                    'left_count' => DB::raw("`left_count`+".(1)),
                    'total_left_count' => DB::raw("`total_left_count`+".(1)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            }else{
                //Check Right count already had previous value
                $update_right_count = DB::table('tree')
                ->where('id', $parent)
                ->update([
                    'right_count' => DB::raw("`right_count`+".(1)),
                    'total_right_count' => DB::raw("`total_right_count`+".(1)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            }   
            
            //Pair checking
            $total_pair_count =  DB::table('tree')
                ->select('total_pair')
                ->where('id',$parent)
                ->first();
            
            //Fetch Pair Match
            $pair_match = DB::table('tree')
                ->select('left_count', 'right_count')
                ->where('id',$parent)
                ->first();

            //Initial Pair doesn't need to check timeframe also

                if($total_pair_count->total_pair == 0){
                    if($pair_match->right_count >= 2 && $pair_match->left_count >= 1){
                        DB::table('member_pair_timing')
                        ->insert([
                            'user_id' => $parent,
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        ]);
                        $this->creditCommisionTwoIsToOneOrOneIsToTwo($parent, 1,2);
                        //Pair Update
                        DB::table('tree')
                            ->where('id', $parent)
                            ->update([
                                'total_pair' => DB::raw("`total_pair`+".(1)),
                            ]);
                    }else if($pair_match->left_count >= 2 && $pair_match->right_count >= 1){
                        DB::table('member_pair_timing')
                        ->insert([
                            'user_id' => $parent,
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        ]);

                        $this->creditCommisionTwoIsToOneOrOneIsToTwo($parent, 2,1);

                        DB::table('tree')
                        ->where('id', $parent)
                        ->update([
                            'total_pair' => DB::raw("`total_pair`+".(1)),
                        ]);
                    }
                }else{
                    //Check 1:1 Check
                    if($pair_match->right_count > 0 && $pair_match->left_count  > 0){
                        DB::table('member_pair_timing')
                        ->insert([
                            'user_id' => $parent,
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                        ]);

                        $this->creditCommisionOneIsToOne($parent, 1, 1);

                        $totla_pair_update = DB::table('tree')
                        ->where('id', $parent)
                        ->update([
                            'total_pair' => DB::raw("`total_pair`+".(1)),
                        ]);
                    }
                }

            $child = $parent;
        }
    }
    function creditCommisionTwoIsToOneOrOneIsToTwo($parent, $left, $right){
        $update_left_count = DB::table('tree')
        ->where('id', $parent)
        ->update([
            'left_count' => DB::raw("`left_count`-".($left)),
            'right_count' => DB::raw("`right_count`-".($right)),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
            
            //Fetch User with Node ID
            $fetch_user = DB::table('tree')
            ->where('id', $parent)
            ->first();        
            
            //Fetch Matching Income
            $matching_income = DB::table('matching_income')->first();
            
            $wallet_insert = DB::table('wallet') 
            ->where('user_id', $fetch_user->user_id)
            ->update([
                'amount' => DB::raw("`amount`+".($matching_income->income)),
                ]);
                
            //Fetch Wallet
            $fetch_wallet = DB::table('wallet')->where('user_id', $fetch_user->user_id)->first();
            //Fetch Commission History
            $credit_commision = DB::table('commission_history')
                ->insertGetId([
                    'user_id' => $fetch_user->user_id,
                    'pair_number' => ($fetch_user->total_pair+1),
                    'amount' => $matching_income->income,
                    'comment' => $matching_income->income.' income of pair number '.($fetch_user->total_pair+1).' is generated! ',
                    'status' => 1,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
        if($credit_commision){
            $credit_commision_to_wallet = DB::table('wallet_history')
                    ->insertGetId([
                        'wallet_id' =>  $fetch_wallet->id,
                        'user_id'   => $fetch_user->user_id,
                        'transaction_type'  =>  1,
                        'amount' => $matching_income->income,
                        'total_amount'  => $fetch_wallet->amount,
                        'comment'   => $matching_income->income.' income of pair number '.($fetch_user->total_pair+1).' is generated! ',
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                    ]);
        }
    }

    function creditCommisionOneIsToOne($parent, $left, $right){
        $timing = $this->checkTimeFrameDuplication($parent);
        if($timing > 1){
            //If Time frame is duplicate then push the data with status NO
            $this->commisionWithNegative($parent, $left, $right, $cause = 'CAPPING', $status = '2');
        }else{
            // dd("CUTOFF");
            //Check for exact cut-OFF
            $fetch_cutoff = $this->checkCutOFFTiming($parent);

            if($fetch_cutoff > 0){
                $this->commisionWithNegative($parent, $left, $right, $cause = 'CutOFF', $status = '3');
             }else{
                $this->commisionWithPositive($parent, $left, $right);
             }
        }
    }

    function checkTimeFrameDuplication($parent){
        //Pair Timing
        $current_time = Carbon::now()->setTimezone('Asia/Kolkata')->toTimeString();
        $pair_timings = DB::table('pair_timing')->where('from','<=',$current_time)->where('to','>=',$current_time)->first();
        $current_date = Carbon::now()->setTimezone('Asia/Kolkata')->toDateString();
        $time_frame_from = $current_date." ".$pair_timings->from;
        $time_frame_to = $current_date." ".$pair_timings->to;
        $member_pair_timings = DB::table('member_pair_timing')
            ->where('user_id', $parent)
            ->whereBetween('created_at', [$time_frame_from, $time_frame_to])
            ->count();
        return $member_pair_timings;
    }

    public function checkCutOFFTiming($parent){
        //Fetch User with Node ID
        $fetch_tree = DB::table('tree')
        ->where('id', $parent)
        ->first();   

        //Fetch cutoff
        $fetch_cutoff = DB::table('cutoff')->where('cutoff', $fetch_tree->total_pair)->count();
        return $fetch_cutoff;
    }

    public function commisionWithPositive($parent, $left, $right){

        //INsert Comission Data
        $update_left_right_count = DB::table('tree')
        ->where('id', $parent)
        ->update([
            'left_count' => DB::raw("`left_count`-".($left)),
            'right_count' => DB::raw("`right_count`-".($right)),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
        ]);
       
        //Fetch User with Node ID
        $fetch_tree = DB::table('tree')
        ->where('id', $parent)
        ->first();        

        //Fetch Matching Income
        $matching_income = DB::table('matching_income')->first();

        $wallet_insert = DB::table('wallet') 
        ->where('user_id', $fetch_tree->user_id)
        ->update([
            'amount' => DB::raw("`amount`+".($matching_income->income)),
            ]);
            
        //Fetch Wallet
        $fetch_wallet = DB::table('wallet')->where('user_id', $fetch_tree->user_id)->first();
        
        $credit_commision = DB::table('commission_history')
        ->insertGetId([
            'user_id' => $fetch_tree->user_id,
            'pair_number' => ($fetch_tree->total_pair+1),
            'amount' => $matching_income->income,
            'comment' => $matching_income->income.' income of pair number '.($fetch_tree->total_pair+1).' is generated! ',
            'status' => 1,
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);

        if($credit_commision){
            $credit_commision_to_wallet = DB::table('wallet_history')
                ->insertGetId([
                    'wallet_id' =>  $fetch_wallet->id,
                    'user_id'   => $fetch_tree->user_id,
                    'transaction_type'  =>  1,
                    'amount' => $matching_income->income,
                    'total_amount'  => $fetch_wallet->amount,
                    'comment'   => $matching_income->income.' income of pair number'.($fetch_tree->total_pair+1).' is generated! ',
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
        }
    }

    public function commisionWithNegative($parent, $left, $right, $cause, $status){

        //IF More than 1 data returns, Insert data with status NO
        $update_left_right_count = DB::table('tree')
        ->where('id', $parent)
        ->update([
            'left_count' => DB::raw("`left_count`-".($left)),
            'right_count' => DB::raw("`right_count`-".($right)),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
        ]);
        //Fetch User with Node ID
        $fetch_tree = DB::table('tree')
        ->where('id', $parent)
        ->first();        
        
        //Fetch Matching Income
        $matching_income = DB::table('matching_income')->first();

        //Fetch Wallet
        $fetch_wallet = DB::table('wallet')->where('user_id', $fetch_tree->user_id)->first();


        $credit_commision = DB::table('commission_history')
        ->insertGetId([
            'user_id' => $fetch_tree->user_id,
            'pair_number' =>  ($fetch_tree->total_pair+1),
            'amount' => 0.00,
            'comment' => 'Pair number '.($fetch_tree->total_pair+1).' is on '.$cause.'! ',
            'status' => $status,
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
    }

}
