<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Auth;
use Carbon\Carbon;
use Hash;
use App\Member;
use App\ImportantNotice;
use App\Feedback;
use Illuminate\Support\Str;
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

        $notice = ImportantNotice::where('status', 1)->orderBy('created_at', 'DESC')->limit(10)->get();
        return view('member.dashboard', compact('my_commission', 'total_pair_completed', 'epin_available', 'epin_used', 'my_wallet', 'epin_list', 'notice'));
    }

    public function profile(){
        $member = Member::findOrFail(Auth::user()->id);
        return view('member.profile', compact('member'));
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
    
    public function productPage($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }
        if (Session::has('product_page_token') && !empty(Session::get('product_page_token'))) {
            $session_token = Session::get('product_page_token');
            if ( $session_token == $token) {
                $products = DB::table('member_product')->paginate(9);
                return view('member.registration.product_page', compact('products'));
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
            ->addColumn('member_id', function($row){
                $user_id = $row->user_id;
                if(!empty($user_id)){
                    $member_id =  DB::table('tree')
                        ->select('members.member_id as member_id')
                        ->join('members', 'members.id', '=', 'tree.user_id')
                        ->where('tree.user_id', $row->user_id)
                        ->value('members.member_id');
                }
                return $member_id;
            })
            ->addColumn('parent', function($row){
                $parents = $row->parent_id;
                if (!empty($parents)) {
                    $parent_details =  DB::table('tree')
                    ->select('members.name as u_name','members.id as u_id', 'members.member_id as member_id')
                    ->join('members','members.id','=','tree.user_id')
                    ->where('tree.id',$row->parent_id)
                    ->first();
                   $parent = $parent_details->member_id;
                   if ($row->user_id == $parent_details->u_id) {
                        $parent .=" (Self)";
                    }else{
                        $parent .=" (".$parent_details->u_name.")";
                   }
                   return $parent;
                }
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
                $lft_members = $row->left_id;
                if (!empty($lft_members)) {
                    $lft_details =  DB::table('tree')
                   ->select('members.name as u_name','members.id as u_id', 'members.member_id as member_id', 'members.epin')
                   ->join('members','members.id','=','tree.user_id')
                   ->where('tree.id',$lft_members)
                   ->first();
                    $lft_member = $lft_details->member_id;
                   if ($row->user_id == $lft_details->u_id) {
                        $lft_member.=" (Self)";
                    }else{
                        if($lft_details->epin){
                            $lft_member.=" (".$lft_details->u_name.")";
                        }else{
                            $lft_member.=" (".$lft_details->u_name.") <button class='btn btn-success'>VIEW</button>";
                        }
                   }
                   return $lft_member;
                }
            })
            ->addColumn('right_member', function($row){
                $rht_members = $row->right_id;
               
                if (!empty($rht_members)) {
                    $rht_details =  DB::table('tree')
                    ->select('members.name as u_name','members.id as u_id', 'members.member_id as member_id', 'members.epin')
                   ->join('members','members.id','=','tree.user_id')
                   ->where('tree.id',$rht_members)
                   ->first();
                    $rht_member = $rht_details->member_id;
                   if ($row->user_id == $rht_details->u_id) {
                        $rht_member.=" (Self)";
                    }else{
                        if($rht_details->epin){
                            $rht_member.=" (".$rht_details->u_name.")";
                        }else{
                            $rht_member.=" (".$rht_details->u_name.") <button class='btn btn-success'>VIEW</button>";
                        }
                    }
                    return $rht_member;
                }
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
                        ->select('name','id', 'member_id')
                        ->where('id',$add_by)
                        ->first();
                        $add_by = $user_details->member_id;
                        $add_by.= "(".$user_details->name.")";
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
    public function ajaxGetWalletHistory(){
        $query = DB::table('wallet_history')
            ->orderBy('id','desc')
            ->where('user_id', Auth::user()->id);
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->make(true);
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
                        ->where('tree.user_id', $first->id)
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
                        ->where('tree.user_id', $first->id)
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
                                ->where('tree.user_id', $second->id)
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
                                ->where('tree.user_id', $second->id)
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
                                        ->where('tree.user_id', $third->id)
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
                                        ->where('tree.user_id', $third->id)
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
                                                ->where('tree.user_id', $fourth->id)
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
                                                ->where('tree.user_id', $fourth->id)
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
                                                        ->where('tree.user_id', $fifth->id)
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
                                                        ->where('tree.user_id', $fifth->id)
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

    public function changePasswordPage()
    {
        return view('member.change_password');
    }

    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with('error','Your current password does not matches with the password you provided. Please try again.');
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }


        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("message","Password changed successfully !");

    }

    public function accountUpdatePage()
    {
        $member = Member::findOrFail(Auth::user()->id);
        return view('member.account', compact('member'));
    }

    public function updateMember(Request $request)
    {   
        $this->validate($request, [
            'member_name'   => 'required',
            'mobile'        => 'required',
            'email'         => 'required|email'
        ]);
        
        $member = Member::find(Auth::user()->id);
        $member->name = $request->input('member_name');
        $member->mobile = $request->input('mobile');
        $member->email = $request->input('email');
        $member->gender = $request->input('gender');
        $member->dob = $request->input('dob');

        if($member->save()){
            return redirect()->back()->with('message', 'Account Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function getNotice($nId)
    {
        try{
            $id = decrypt($nId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $notice = ImportantNotice::findOrFail($id);
        return view('member.view_notice', compact('notice'));
    }

    public function feedBack()
    {
        return view('member.feedback');
    }

    public function storeComplaint(Request $request)
    {
        $this->validate($request, [
            'complaint'   => 'required'
        ]);
        
        $feedback = new Feedback;
        $feedback->feedback = $request->input('complaint');
        $feedback->added_by = Auth::user()->name;
        if($feedback->save()){
            return redirect()->back()->with('message', 'Complain/ Feedback Added');
        }
    }

    public function ckEditorImageUpload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
       
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
       
            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();
       
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
       
            //Upload File
            // $request->file('upload')->storeAs('assets/category/ckeditor/', $filenametostore);

            $request->file('upload')->move(public_path('assets/ckeditor'), $filenametostore);
     
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/ckeditor/'.$filenametostore); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
              
            // Render HTML output 
            @header('Content-type: text/html; charset=utf-8'); 
            echo $re;
        }
    } 
    
    public function getFeedbackList(){
        $query = Feedback::where('added_by', Auth::user()->name)->orderBy('id','desc');
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->addColumn('feedback', function($row){
            $description = Str::words($row->feedback, 10, ' ...');
            return $description;
        })
        ->rawColumns(['feedback'])
        ->make(true);
    }
}
