<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class MemberListController extends Controller
{
    public function memberList(){
        return view('admin.member_list');
    }

    public function ajaxGetMemberList(){
        $query = DB::table('members')
            ->orderBy('id','desc');
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->addColumn('left', function($row){
          $tree = DB::table('tree')->where('user_id', $row->id)->first();
          if($tree->left_id){
               $left = '<span class="label label-success">YES</span>';
               return $left;
          }else{
               $left = '<span class="label label-danger">NO</span>';
               return $left;
          }
          return $left;
       })
        ->addColumn('right', function($row){
           $tree = DB::table('tree')->where('user_id', $row->id)->first();
           if($tree->right_id){
                $right = '<span class="label label-success">YES</span>';
                return $right;
           }else{
                $right = '<span class="label label-danger">NO</span>';
                return $right;
           }
           return $right;
        })
        ->addColumn('document_verify', function($row){
           $members = DB::table('members')->where('document_status', $row->document_status)->first();
           $stat = NULL;
           if($members->document_status == 1){
                $stat = '<span class="label label-success">VERIFIED</span>';
                return $stat;
           }else if($members->document_status == 2){
                $stat = '<span class="label label-warning">NOT VERIFIED</span>';
               return $stat;
           }else if($members->document_status == 3){
                $stat = '<span class="label label-danger">REJECTED</span>';
                return $stat;
           }
           return $stat;
        })
        ->addColumn('document_status', function($row){
           $members = DB::table('members')->where('document_u_status', $row->document_u_status)->first();
           $document_status = NULL;
           if($members->document_u_status == 1){
                $document_status = '<span class="label label-success">UPLOADED</span>';
                return $document_status;
           }else if($members->document_u_status == 2 || $members->document_u_status == NULL){
                $document_status = '<span class="label label-warning">NOT UPLOADED</span>';
               return $document_status;
           }
           return $document_status;
        })
        ->addColumn('action', function($row){
               $btn = '
               <a href="'.route('admin.member_view', ['id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
               <a href="'.route('admin.member_edit', ['id' => encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>              
               <a href="'.route('admin.member_downline', ['id' => encrypt($row->id)]).'" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-code-fork"></i></a>              
               <a href="'.route('admin.member.tree', ['rank' => 0, 'user_id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-tree"></i></a>              
               ';

               if($row->status == '1'){
                    $btn .= '<a href="'.route('admin.member_status', ['id' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>';
                    return $btn;
                }else{
                    $btn .='<a href="'.route('admin.member_status', ['id' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
                    return $btn;
                }
             return $btn;
        })
        ->rawColumns(['left', 'right','action', 'registered_by', 'document_verify', 'document_status'])
        ->make(true);
    }

    public function memberStatus($memberId, $statusId){
     try {
         $id = decrypt($memberId);
         $sId = decrypt($statusId);
     }catch(DecryptException $e) {
         return redirect()->back();
     }

     $status_member = DB::table('members')
         ->where('id', $id)
         ->update([
             'status' => $sId,
             'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
         ]);

     if($sId == 1){
         return redirect()->back()->with('message', 'Activated Successfully!');
     }else{
         return redirect()->back()->with('message', 'Deactivated Successfully');
     }

 }

 public function memberView($vId){
     try {
          $id = decrypt($vId);
      }catch(DecryptException $e) {
          return redirect()->back();
      }

     $fetch_member_data = DB::table('members')->where('id', $id)->first();
     return view('admin.member_details', compact('fetch_member_data'));
 }

 public function memberEdit($vId){
     try {
          $id = decrypt($vId);
      }catch(DecryptException $e) {
          return redirect()->back();
      }

     $fetch_member_data = DB::table('members')->where('id', $id)->first();
     $state = DB::table('state')
          ->orderBy('id','desc')
          ->get();
     $city = DB::table('city')
          ->orderBy('id','desc')
          ->get();  
     return view('admin.member_edit', compact('fetch_member_data', 'state', 'city'));
 }
 
 public function memberUpdate(Request $request){
     $validatedData = $request->validate([
         'f_name' => 'required',
          'email' => 'email:rfc,dns',
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

    $name = $request->input('f_name');
    $email = $request->input('email');
    $mobile = $request->input('mobile');
    $gender = $request->input('gender');
    $dob = $request->input('dob');
    $relation = $request->input('relation');
    $n_name = $request->input('n_name');
    $n_mobile = $request->input('n_mobile');
    $n_address = $request->input('n_address');
    $state = $request->input('state');
    $city = $request->input('city');
    $pin = $request->input('pin');
    $id = $request->input('id');
    
    $update_member = DB::table('members')
        ->where('id', $id)
        ->update([
            'name' => $name,
            'email' => $email,
            'mobile' => $mobile,
            'gender' => $gender,
            'dob' => $dob,
            'nominee_relation' => $relation, 
            'nominee_name' => $n_name,
            'nominee_mobile' => $n_mobile,
            'nominee_address' => $n_address, 
            'state' => $state,
            'city' => $city,
            'pin' => $pin,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
    if($update_member){
        return redirect()->back()->with('message','Updated Successfully!');
    }else {
        return redirect()->back()->with('message', 'Something went wrong!');
    }
}
public function memberVerify($vId, $statusId){
    try {
            $id = decrypt($vId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

   $verify = DB::table('members')
        ->where('id', $id)
        ->update([
            'document_status' => $sId,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
        ]);

    if($verify && $sId == 1){
        return redirect()->back()->with('message', 'Verified Successfully!');
    }else if($verify && $sId == 3){
        return redirect()->back()->with('error', 'Document got Rejected!');
    }
}
public function memberDownline($vId){
    try {
            $id = decrypt($vId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

    $fetch_member_data = DB::table('members')->where('id', $id)->first();
    return view('admin.member_downline', compact('fetch_member_data'));
}
public function memberDownlineList($mId){
    try {
        $id = decrypt($mId);
    }catch(DecryptException $e) {
        return redirect()->back();
    }

    return datatables()->of(DB::select(DB::raw("SELECT * FROM (SELECT * FROM tree
    ORDER BY user_id) items_sorted,
   (SELECT @iv := :user_id) initialisation
   WHERE find_in_set(parent_id, @iv)
   AND length(@iv := concat(@iv, ',', id))"),
    array(
       'user_id' => $id,
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
                $parent.=" (Self)";
            }else{
                $parent.=" (".$parent_details->u_name.")";
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

public function memberCommissionHistory(){
    return view('admin.commission_history');
}
public function memberCommissionHistoryList(){
    $query = DB::table('commission_history')
        ->leftjoin('members', 'commission_history.user_id', '=', 'members.id')
        ->select('commission_history.*', 'members.name as user_name', 'members.member_id as member_id');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('amount', function($row){
                if($row->amount == 900){
                    $amt = '<span class="label label-success">'.$row->amount.'</span>';
                    return $amt;
                }else{
                    $amt = '<span class="label label-warning">'.$row->amount.'</span>';
                    return $amt;
                }
                return $amt;
            })
            ->rawColumns(['amount'])
            ->make(true);
}
public function memberWallet(){
    return view('admin.wallet');
}
public function memberWalletList(){
    $query = DB::table('wallet')
        ->leftjoin('members', 'wallet.user_id', '=', 'members.id')
        ->select('wallet.*', 'members.name as user_name', 'members.member_id as member_id');
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('admin.wallet_history', ['id' => encrypt($row->user_id)]).'" class="btn btn-primary" target="_blank"><i class="fa fa-th-list" aria-hidden="true"></i></a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}

public function memberWalletHistory($hId){
    try {
        $id = decrypt($hId);
    }catch(DecryptException $e) {
        return redirect()->back();
    }
    
    return view('admin.wallet_history', compact('id'));
}
public function memberAjaxWalletHistory($pId){
    try {
        $id = decrypt($pId);
    }catch(DecryptException $e) {
        return redirect()->back();
    }

    $query = DB::table('wallet_history')
        ->leftjoin('members', 'wallet_history.user_id', '=', 'members.id')
        ->select('wallet_history.*', 'members.name as user_name', 'members.member_id as member_id')
        ->where('wallet_history.user_id', $id);
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
   
    return view('admin.tree',compact('html'));
}
}