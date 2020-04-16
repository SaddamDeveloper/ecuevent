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
        return view('member.dashboard');
    }

    public function profile(){
        return view('member.profile');
    }

    public function addNewMemberForm(){
        $state = DB::table('state')
            ->orderBy('id','desc')
            ->get();
        $city = DB::table('city')
            ->orderBy('id','desc')
            ->get();
        return view('member.registration.member_registration_form', compact('state', 'city'));
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

    public function memberTree($rank=null){
        if (empty($rank)) {
            $rank = 0;
        }
        $user_id = Auth::guard('member')->id();
        $html=null;
        $root = DB::table('tree')
            ->select('tree.*', 'members.name', 'members.member_id')
            ->join('members', 'tree.user_id', '=', 'members.id')
            ->where('user_id', $user_id)
            ->first();
        if ($root) {
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
                foreach ($first_level as $key => $first) {
                    $html.="<li>";
                    if ($root->left_id == $first->id) {
                        $first_level_node = DB::table('tree')
                        ->select('tree.*', 'members.name', 'members.member_id')
                        ->join('members', 'tree.user_id', '=', 'members.id')
                        ->where('user_id', $first->id)
                        ->first();
                        $html.='<a href="#">'.$first_level_node->name.'
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
                        $html.='<a href="#">'.$first_level_node->name.'
                            <div class="info">
                                <h5>Name : '.$first_level_node->name.'</h5>
                                <h5>Id : '.$first_level_node->member_id.'</h5>
                                <h5>Rank : '.$rank.'</h5>
                            </div>  
                        </a>';
                    }

                    $second_level = DB::table('tree')->where('parent_id',$first->id)->get();
                    if ($second_level) {
                        $html.="<ul>";
                        foreach ($second_level as $key => $second) {
                            $html.="<li>";
                            if ($root->left_id == $first_level_node->id) {
                                $second_level_node = DB::table('tree')
                                ->select('tree.*', 'members.name', 'members.member_id')
                                ->join('members', 'tree.user_id', '=', 'members.id')
                                ->where('user_id', $second->id)
                                ->first();
                                $html.='<a href="#">'.$second_level_node->name.'
                                    <div class="info">
                                        <h5>Name : '.$second_level_node->name.'</h5>
                                        <h5>Id : '.$second_level_node->member_id.'</h5>
                                        <h5>Rank : '.$rank.'</h5>
                                    </div>  
                                </a>';
                            } else if($root->right_id == $first_level_node->id){
                                $second_level_node = DB::table('tree')
                                ->select('tree.*', 'members.name', 'members.member_id')
                                ->join('members', 'tree.user_id', '=', 'members.id')
                                ->where('user_id', $second->id)
                                ->first();
                                $html.='<a href="#">'.$second_level_node->name.'
                                    <div class="info">
                                        <h5>Name : '.$second_level_node->name.'</h5>
                                        <h5>Id : '.$second_level_node->member_id.'</h5>
                                        <h5>Rank : '.$rank.'</h5>
                                    </div>  
                                </a>';
                            }
                            
                            $html.="</li>";
                        }
                        $html.="</ul>";
                    }
                    /////////////////////Second End
                    $html.="</li>";
                }
                $html.="</ul>";
            }

            $html.="
                </li>
            </ul>";
        }     
       
        return view('member.tree',compact('html'));
    }

    public function memberTreeData(Request $request){
        if($request->ajax()){
            $user_id = $request->get('query');
            $output = '';
            if(!empty($user_id)){
                $first_level = DB::table('tree')
                    ->select('tree.*', 'members.name', 'members.member_id')
                    ->join('members', 'tree.user_id', '=', 'members.id')
                    ->where('user_id', $user_id)
                    ->first();
                if($first_level){
                    $output .= '<ul>
                    <li>        
                        <a href="#">'.$first_level->name.'
                            <div class="info">
                                <h5>Name : '.$first_level->name.'</h5>
                                <h5>Id : '.$first_level->member_id.'</h5>
                                <h5>Rank : 1</h5>
                            </div>
                        </a>';
                        $left_node = DB::table('tree')
                            ->select('tree.*', 'members.name', 'members.member_id')
                            ->join('members', 'tree.left_id', '=', 'members.id')
                            ->where('left_id', $first_level->left_id)
                            ->first();
                        $right_node = DB::table('tree')
                            ->select('tree.*', 'members.name', 'members.member_id')
                            ->join('members', 'tree.right_id', '=', 'members.id')
                            ->where('right_id', $first_level->right_id)
                            ->first();
                        if($left_node){
                            $output .= '<ul>
                                            <li>
                                                <a href="#">'.$left_node->name.'
                                                    <div class="info">
                                                        <h5>Name : '.$left_node->name.'</h5>
                                                        <h5>Id : '.$left_node->member_id.'</h5>
                                                        <h5>Rank : 2</h5>
                                                    </div>  
                                                </a>
                                            </li>
                                        </ul> </li>
                                        </ul>';
                        }else if($right_node){
                            dd(2);
                            $output .= '
                            <ul>
                                <li>
                                <a href="#">'.$right_node->name.'
                                    <div class="info">
                                        <h5>Name : '.$right_node->name.'</h5>
                                        <h5>Id : '.$right_node->member_id.'</h5>
                                        <h5>Rank : 2</h5>
                                    </div>  
                                </a>
                                </li></ul>';
                        }else if($left_node && $right_node){
                            dd(123);
                            $output .= '
                            <ul>
                                <li>
                                    <a href="#">'.$left_node->name.'
                                        <div class="info">
                                            <h5>Name : '.$left_node->name.'</h5>
                                            <h5>Id : '.$left_node->member_id.'</h5>
                                            <h5>Rank : 2</h5>
                                        </div>  
                                    </a>
                                    
                                </li>
                                <li>
                                    <a href="#">'.$right_node->name.'
                                        <div class="info">
                                            <h5>Name : '.$right_node->name.'</h5>
                                            <h5>Id : '.$right_node->member_id.'</h5>
                                            <h5>Rank : 2</h5>
                                        </div>  
                                    </a>
                                </li>
                            </ul>';
                        }
                        }else{
                            $output .= '</li>
                            </ul>';
                        }
                return $output;
                }else{
                    return 1;
                }
            }else{
                return 1;
            }
        }
    }
