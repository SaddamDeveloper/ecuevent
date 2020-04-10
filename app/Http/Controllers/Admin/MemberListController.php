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
                $stat = '<span class="label label-danger">NOT VERIFIED</span>';
               return $stat;
           }
           return $stat;
        })
        ->addColumn('document_status', function($row){
           $members = DB::table('members')->where('document_u_status', $row->document_u_status)->first();
           $stat = NULL;
           if($members->document_u_status == 1){
                $stat = '<span class="label label-success">UPLOADED</span>';
                return $stat;
           }else if($members->document_u_status == 2){
                $stat = '<span class="label label-danger">NOT UPLOADED</span>';
               return $stat;
           }
           return $stat;
        })
        ->addColumn('action', function($row){
               $btn = '
               <a href="'.route('admin.member_view', ['id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
               <a href="'.route('admin.member_edit', ['id' => encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank"><i class="fa fa-pencil"></i></a>              
               <a href="'.route('admin.member_downline', ['id' => encrypt($row->id)]).'" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-code-fork"></i></a>              
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
public function memberVerify($vId){
    try {
            $id = decrypt($vId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

    $fetch_member_data = DB::table('members')->where('id', $id)->first();
    return view('admin.member_verify', compact('fetch_member_data'));
}
public function memberDownline($vId){
        try {
                $id = decrypt($vId);
            }catch(DecryptException $e) {
                return redirect()->back();
            }

        $fetch_member_data = DB::table('members')->where('id', $id)->first();
       dd($fetch_member_data);
        return view('admin.member_edit', compact('fetch_member_data', 'state', 'city'));
}
}
