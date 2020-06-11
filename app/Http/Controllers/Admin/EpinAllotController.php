<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\EpinRequest;
class EpinAllotController extends Controller
{
    public function memAllotEpinForm(){
        return view('admin.allot_epin_form');
    }

    public function searchMemberID(Request $request){
        if($request->ajax()){
            $member_id = $request->get('query');
            if (!empty($member_id)) {
                $member_data = DB::table('members')->where('member_id', $member_id)->first();
                if($member_data) {
                    $html = '
                    <label for="name">Name</label>
                    <input type="text" value="'.$member_data->name.'" class="form-control" readonly placeholder="Name">
                    <label for="gender">Mobile</label>
                    <input type="text" value="'.$member_data->mobile.'" class="form-control" readonly placeholder="Mobile">
                    <label for="gender">DOB</label>
                    <input type="text" value="'.$member_data->dob.'" class="form-control" readonly placeholder="DOB"><br>
                    <label for="name">How many EPIN you will be alloted?</label>
                    <input type="text" class="form-control" name="epin"  placeholder="How many EPIN you will be alloted?"><br>
                    ';
                    echo $html;
                }
                else{
                    return 5;
                }
            }  
            else{
                return 1;
            }
        }
        else{
            return 9;
        }
    }

    public function memAllotEpin(Request $request){
        $validatedData = $request->validate([
            'epin' => 'required',
        ]);
        
        $epin_total = $request->input('epin');
        $member_id = $request->input('searchMember');
        $member_data_fetch = DB::table('members')->where('member_id', $member_id)->first();

        //Check used EPIN
        $epin_count = DB::table('epin')->whereNull('alloted_to')->where('status', 2)->count();
        if($epin_count < $epin_total){
            return redirect()->back()->with('error', ''.$epin_total.' EPIN is not available. Please generate more EPIN to allot.');
        }
        $epin_fetch = DB::table('epin')->whereNull('alloted_to')->where('status', 2)->limit($epin_total)->orderBy('id', 'ASC')->get();
        foreach ($epin_fetch as $epin) {
            $epin_alloted_to = DB::table('epin')
                ->where('id', $epin->id)
                ->update([
                    'alloted_to' => $member_data_fetch->id,
                    'alloted_date' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }
        return redirect()->back()->with('message', ''.$epin_total.' EPIN is alloted successfully to '.$member_data_fetch->name.'');
    }

    public function epinRequestsLists()
    {
        return datatables()->of(EpinRequest::orderBy('created_at', 'DESC')->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.epin_req_status', ['sId' => encrypt($row->id), 'status'=> encrypt(2)]).'" class="btn btn-success">Solve</a>';
            }else{
                $action = '<a href="#" class="btn btn-danger" disabled>Solved</a>';
            }
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function epinRequestStatus($aId, $statusId)
    {
        try {
            $id = decrypt($aId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $update = EpinRequest::where('id', $id)->update(array('status' => $sId));
        if($update){
            return redirect()->back()->with('message','Updated Successfully');
        }else {
            return redirect()->back()->with('error', 'Something Went Wrong Please Try Again');
        }
    }
}
