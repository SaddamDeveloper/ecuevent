<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Auth;
use Carbon\Carbon;
class MemberDashboardController extends Controller
{
    public function index(){
        $my_commission = DB::table('commission_history')
            ->where('user_id', Auth::user()->id)
            ->sum('amount');
        $total_pair_completed = DB::table('tree')
            ->where('user_id', Auth::user()->id)
            ->value('total_pair');
        $epin_available = DB::table('epin')
            ->where('status', 2)
            ->where('alloted_to', Auth::user()->id)
            ->count();
        $epin_used = DB::table('epin')
            ->where('status', 1)
            ->where('alloted_to', Auth::user()->id)
            ->count();
        $my_wallet = DB::table('wallet')
            ->where('user_id', Auth::user()->id)
            ->value('amount');

        $epin_list = DB::table('epin')
            ->select('epin.*', 'members.name as name','used_by.name as used_by_name')
            ->leftjoin('members', 'epin.alloted_to', '=', 'members.id')
            ->leftjoin('members as used_by', 'epin.used_by', '=', 'used_by.id')
            ->where('epin.alloted_to', Auth::user()->id)
            ->orderBy('epin.id', 'DESC')
            ->limit(10)
            ->get();

        return view('member.dashboard', compact('my_commission', 'total_pair_completed', 'epin_available', 'epin_used', 'my_wallet', 'epin_list'));
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

    public function addTermsForm($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('terms_page_token') && !empty(Session::get('terms_page_token'))) {
            $session_token = Session::get('terms_page_token');
            if ( $session_token == $token) {
                return view('member.registration.add_terms_form');
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
       
    }
    
    public function productPage($token,$user_id){
        try{
            $token = decrypt($token);
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            abort(404);
        }
        if (Session::has('product_page_token') && !empty(Session::get('product_page_token'))) {
            $session_token = Session::get('product_page_token');
            if ( $session_token == $token) {
                $products = DB::table('member_product')->take(3)->get();
                return view('member.registration.product_page', compact('products','user_id'));
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
       
    }

    public function kycPage($token, $user_id){
        try{
            $token = decrypt($token);
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('kyc_page_token') && !empty(Session::get('kyc_page_token'))) {
            $session_token = Session::get('kyc_page_token');
            if ( $session_token == $token) {
               
                // $products = DB::table('member_product')->take(3)->get();
                return view('member.registration.kyc_page', compact('user_id'));
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function finishPage($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }
        
        if($token){
                $delete_previous_session = session()->forget('kyc_page_token');
                $success = 'Registration Successfull';
                return view('member.registration.finish_page', compact('success'));
        }else{
            abort(404);
        }
    }

    public function msgHelper(){
        $notVerified = DB::table('members')->where('document_status', 2)->first();

        if($notVerified){
            $msg = "Document is uploaded but not verified yet!";
            return view('member.template.member_master', compact('msg'));
        }
    }

    public function memberCommissionListForm(){
        return view('member.commission');
    }
    
    public function memberOrderListForm(){
        return view('member.order');
    }

    public function memberDownlineListForm(){
        return view('member.downline');
    }
    
    public function memberGetDownlineList(){

        return datatables()->of(DB::select(DB::raw("SELECT * FROM (SELECT * FROM tree
            ORDER BY user_id) items_sorted,
           (SELECT @iv := :user_id) initialisation
           WHERE find_in_set(parent_id, @iv)
           AND length(@iv := concat(@iv, ',', id))"),
            array(
                'user_id' => Auth::user()->id,
                )))
            ->addIndexColumn()
            ->addColumn('parent', function($row){
                $parent = $row->parent_id;
                if (!empty($parent)) {
                    $parent_details =  DB::table('tree')
                    ->select('members.name as u_name','members.id as u_id')
                    ->join('members','members.id','=','tree.user_id')
                    ->where('tree.id',$row->parent_id)
                    ->first();
                   
                   if ($row->user_id == $parent_details->u_id) {
                        $parent .=" (Self)";
                    }else{
                        $parent .=" (".$parent_details->u_name.")";
                   }
                }
                return $parent;
            })
            ->addColumn('member_name', function($row){
                $member_name = null;
                if (!empty($row->user_id)) {
                    $member_details =  DB::table('members')
                    ->select('name','id')
                    ->where('id',$row->user_id)
                   ->first();
                   $member_name =$member_details->name;
                }
                return $member_name;
            })
            ->addColumn('left_member', function($row){
                $lft_member = $row->left_id;
                if (!empty($lft_member)) {
                    $lft_details =  DB::table('tree')
                   ->select('members.name as u_name','members.id as u_id')
                   ->join('members','members.id','=','tree.user_id')
                   ->where('tree.id',$lft_member)
                   ->first();

                   if ($row->user_id == $lft_details->u_id) {
                        $lft_member.=" (Self)";
                    }else{
                        $lft_member.=" (".$lft_details->u_name.")";
                   }
                }
                return $lft_member;
            })
            ->addColumn('right_member', function($row){
                $rht_member = $row->right_id;
               
                if (!empty($rht_member)) {
                    $rht_details =  DB::table('tree')
                    ->select('members.name as u_name','members.id as u_id')
                   ->join('members','members.id','=','tree.user_id')
                   ->where('tree.id',$rht_member)
                   ->first();

                   if ($row->user_id == $rht_details->u_id) {
                        $rht_member.=" (Self)";
                    }else{
                        $rht_member.=" (".$rht_details->u_name.")";
                    }
                }else{
                    $rht_member='';
                }
                return $rht_member;
            })
            ->addColumn('add_by', function($row){
                $add_by = $row->registered_by;
                if (!empty($add_by)) {
                    if (substr($add_by, -1) == "A") {
                    $add_by = "ADMIN";
                }elseif($row->user_id == $add_by){
                    $add_by = "SELF";
                  }else{
                      $user_details =  DB::table('members')
                        ->select('name','id')
                        ->where('id',$add_by)
                        ->first();
                        $add_by.=$add_by." (".$user_details->name.")";
                    }
                }
                return $add_by;
            })
            ->addColumn('created_at', function($row){
                $created_at = Carbon::parse($row->created_at)->toDayDateTimeString();
                return $created_at;
            })
            ->rawColumns(['parent','member_name','left_member','right_member','add_by','created_at'])
            ->make(true);
    }

    public function memberWalletListForm(){
        $wallet = DB::table('wallet')
            ->where('user_id', Auth::user()->id)
            ->first();
        $amount = $wallet->amount;
        return view('member.wallet', compact('amount'));
    }

    public function memberTree($rank=null, $user_id=null){
        
       
        if (!empty($user_id)) {
            try{
                $user_id = decrypt($user_id);
            }catch(DecryptException $e) {
                abort(404);
            }
        }else{
            $user_id = Auth::guard('member')->id();
        }
        
        if (empty($rank)) {
            $rank = 0;
        }

        $html=null;
        $root = DB::table('tree')
            ->select('tree.*', 'members.name', 'members.member_id')
            ->join('members', 'tree.user_id', '=', 'members.id')
            ->where('user_id', $user_id)
            ->first();
        if($root){
            $html = '<ul>
            <li>        
                <a href="#">'.$root->name.'
                    <div class="info">
                        <h5>Name : '.$root->name.'</h5>
                        <h5>Id : '.$root->member_id.'</h5>
                        <h5>Rank : '.$rank.'</h5>
                    </div>
                </a>';
            $rank++;
            $first_level = DB::table('tree')->where('parent_id',$root->id)->get();
            if ($first_level) {
                $html.="<ul>";
                if(empty($root->left_id)){
                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                }
                foreach ($first_level as $key => $first) {
                    $html.="<li>";
                    if ($root->left_id == $first->id) {
                        $first_level_node = DB::table('tree')
                        ->select('tree.*', 'members.name', 'members.member_id')
                        ->join('members', 'tree.user_id', '=', 'members.id')
                        ->where('user_id', $first->id)
                        ->first();
                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'">'.$first_level_node->name.'
                            <div class="info">
                                <h5>Name : '.$first_level_node->name.'</h5>
                                <h5>Id : '.$first_level_node->member_id.'</h5>
                                <h5>Rank : '.$rank.'</h5>
                            </div>  
                        </a>';
                    } else if($root->right_id == $first->id){
                        $first_level_node = DB::table('tree')
                        ->select('tree.*', 'members.name', 'members.member_id')
                        ->join('members', 'tree.user_id', '=', 'members.id')
                        ->where('user_id', $first->id)
                        ->first();
                        $html.='<a href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($first->user_id)]).'">'.$first_level_node->name.'
                            <div class="info">
                                <h5>Name : '.$first_level_node->name.'</h5>
                                <h5>Id : '.$first_level_node->member_id.'</h5>
                                <h5>Rank : '.$rank.'</h5>
                            </div>  
                        </a>';
                    }

                    $second_level = DB::table('tree')->where('parent_id',$first->id)->orderBy('parent_leg', 'ASC')->get();


                    if ($second_level) {
                        $html.="<ul>";
                        if(empty($first->left_id)){
                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                        }
                        foreach ($second_level as $key => $second) {
                            $html.="<li>";
                            if ($first->left_id == $second->id) {
                                $second_level_node = DB::table('tree')
                                ->select('tree.*', 'members.name', 'members.member_id')
                                ->join('members', 'tree.user_id', '=', 'members.id')
                                ->where('user_id', $second->id)
                                ->first();
                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'">'.$second_level_node->name.'
                                            <div class="info">
                                                <h5>Name : '.$second_level_node->name.'</h5>
                                                <h5>Id : '.$second_level_node->member_id.'</h5>
                                                <h5>Rank : '.$rank.'</h5>
                                            </div>  
                                        </a>';
                            } else if($first->right_id == $second->id){
                                $second_level_node = DB::table('tree')
                                ->select('tree.*', 'members.name', 'members.member_id')
                                ->join('members', 'tree.user_id', '=', 'members.id')
                                ->where('user_id', $second->id)
                                ->first();
                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($second->user_id)]).'">'.$second_level_node->name.'
                                    <div class="info">
                                        <h5>Name : '.$second_level_node->name.'</h5>
                                        <h5>Id : '.$second_level_node->member_id.'</h5>
                                        <h5>Rank : '.$rank.'</h5>
                                    </div>  
                                </a>';
                            }

                            //THIRD LEVEL STARTS
                            $third_level = DB::table('tree')->where('parent_id',$second->id)->orderBy('parent_leg', 'ASC')->get();

                           
                            
                            if ($third_level) {
                                $html.="<ul>";
                                if(empty($second->left_id)){
                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                }
                                foreach ($third_level as $key => $third) {
                                    $html.="<li>";
                                    if ($second->left_id == $third->id) {
                                        $third_level_node = DB::table('tree')
                                        ->select('tree.*', 'members.name', 'members.member_id')
                                        ->join('members', 'tree.user_id', '=', 'members.id')
                                        ->where('user_id', $third->id)
                                        ->first();
                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'">'.$third_level_node->name.'
                                            <div class="info">
                                                <h5>Name : '.$third_level_node->name.'</h5>
                                                <h5>Id : '.$third_level_node->member_id.'</h5>
                                                <h5>Rank : '.$rank.'</h5>
                                            </div>  
                                        </a>';
                                    } else if($second->right_id == $third->id){
                                        $third_level_node = DB::table('tree')
                                        ->select('tree.*', 'members.name', 'members.member_id')
                                        ->join('members', 'tree.user_id', '=', 'members.id')
                                        ->where('user_id', $third->id)
                                        ->first();
                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($third->user_id)]).'">'.$third_level_node->name.'
                                            <div class="info">
                                                <h5>Name : '.$third_level_node->name.'</h5>
                                                <h5>Id : '.$third_level_node->member_id.'</h5>
                                                <h5>Rank : '.$rank.'</h5>
                                            </div>  
                                        </a>';
                                    }
                                    //FOURTH LEVEL STARTS
                                    $fourth_level = DB::table('tree')->where('parent_id',$third->id)->orderBy('parent_leg', 'ASC')->get();
                                    if ($fourth_level) {
                                        $html.="<ul>";
                                        if(empty($third->left_id)){
                                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                        }
                                        foreach ($fourth_level as $key => $fourth) {
                                            $html.="<li>";
                                            if ($third->left_id == $fourth->id) {
                                                $fourth_level_node = DB::table('tree')
                                                ->select('tree.*', 'members.name', 'members.member_id')
                                                ->join('members', 'tree.user_id', '=', 'members.id')
                                                ->where('user_id', $fourth->id)
                                                ->first();
                                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'">'.$fourth_level_node->name.'
                                                    <div class="info">
                                                        <h5>Name : '.$fourth_level_node->name.'</h5>
                                                        <h5>Id : '.$fourth_level_node->member_id.'</h5>
                                                        <h5>Rank : '.$rank.'</h5>
                                                    </div>  
                                                </a>';
                                            } else if($third->right_id == $fourth->id){
                                                $fourth_level_node = DB::table('tree')
                                                ->select('tree.*', 'members.name', 'members.member_id')
                                                ->join('members', 'tree.user_id', '=', 'members.id')
                                                ->where('user_id', $fourth->id)
                                                ->first();
                                                $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fourth->user_id)]).'">'.$fourth_level_node->name.'
                                                <div class="info">
                                                    <h5>Name : '.$fourth_level_node->name.'</h5>
                                                    <h5>Id : '.$fourth_level_node->member_id.'</h5>
                                                    <h5>Rank : '.$rank.'</h5>
                                                </div>  
                                            </a>';
                                            }

                                            // FIFTH LEVEL STARTS
                                            $fifth_level = DB::table('tree')->where('parent_id',$fourth->id)->orderBy('parent_leg', 'ASC')->get();
                                            if ($fifth_level) {
                                                $html.="<ul>";
                                                if(empty($fourth->left_id)){
                                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                                }
                                                foreach ($fifth_level as $key => $fifth) {
                                                    $html.="<li>";
                                                    if ($fourth->left_id == $fifth->id) {
                                                        $fifth_level_node = DB::table('tree')
                                                        ->select('tree.*', 'members.name', 'members.member_id')
                                                        ->join('members', 'tree.user_id', '=', 'members.id')
                                                        ->where('user_id', $fifth->id)
                                                        ->first();
                                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'">'.$fifth_level_node->name.'
                                                            <div class="info">
                                                                <h5>Name : '.$fifth_level_node->name.'</h5>
                                                                <h5>Id : '.$fifth_level_node->member_id.'</h5>
                                                                <h5>Rank : '.$rank.'</h5>
                                                            </div>  
                                                        </a>';
                                                    } else if($fourth->right_id == $fifth->id){
                                                        $fifth_level_node = DB::table('tree')
                                                        ->select('tree.*', 'members.name', 'members.member_id')
                                                        ->join('members', 'tree.user_id', '=', 'members.id')
                                                        ->where('user_id', $fifth->id)
                                                        ->first();
                                                        $html.='<a  href="'.route('member.tree', ['rank' => 0,'user_id' => encrypt($fifth->user_id)]).'">'.$fifth_level_node->name.'
                                                        <div class="info">
                                                            <h5>Name : '.$fifth_level_node->name.'</h5>
                                                            <h5>Id : '.$fifth_level_node->member_id.'</h5>
                                                            <h5>Rank : '.$rank.'</h5>
                                                        </div>  
                                                    </a>';
                                                    }
                                                }
                                                if(empty($fourth->right_id)){
                                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                                }
                                                $html.="</ul>";
                                            }
                                            $html.="</li>";
                                        }
                                        if(empty($third->right_id)){
                                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                        }
                                        $html.="</ul>";
                                    }
                                    $html.="</li>";
                                }
                                if(empty($second->right_id)){
                                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                                }
                                
                                $html.="</ul>";
                                /////THIRD LEVEL ENDS
                            }

                            $html.="</li>";
                        }
                        if(empty($first->right_id)){
                            $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                        }
                        $html.="</ul>";
                    }
                    /////////////////////Second End
                    $html.="</li>";
                }
                if(empty($root->right_id)){
                    $html.='<li><a href="#" style="background-color: grey; color: white;">Empty</a></li>';
                }
                $html.="</ul>";
            }

            $html.="
                </li>
            </ul>";
        }     
       
        return view('member.tree',compact('html'));
    }
    }
