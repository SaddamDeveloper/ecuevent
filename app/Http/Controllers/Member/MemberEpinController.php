<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\EpinRequest;
use Carbon\Carbon;
class MemberEpinController extends Controller
{
    public function memberEpinListForm(){
        return view('member.epin');
    }

    public function memberGetEpinList(){
        $query = DB::table('epin')
                ->leftjoin('members', 'epin.alloted_to', '=', 'members.id')
                ->select('epin.*', 'members.name as name')
                ->where('members.id', Auth::user()->id);
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('used_by', function($row){
                $used_by = DB::table('members')
                    ->select('epin.*', 'members.name as used_by')
                    ->join('epin','members.id', '=', 'epin.used_by')
                    ->where('members.id', $row->used_by)
                    ->first();
                if($used_by){
                    return $used_by->used_by;
                }
            })
            ->rawColumns(['used_by'])
            ->make(true);
    }

    public function memberRequestForm()
    {
        return view('member.epin_request');
    }

    public function memberRequest(Request $request)
    {
        $this->validate($request, [
            'howEpin' => 'required|numeric'
        ]);

        $epin_request = new EpinRequest;
        $epin_request->epin_request = $request->input('howEpin');
        $epin_request->added_by = Auth::user()->name;

        if($epin_request->save()){
            return redirect()->back()->with('message', 'Successfully Added!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong Please Try Again');
        }
    }

    public function epinRequestList()
    {
        $query = EpinRequest::orderBy('id','desc');
        return datatables()->of($query->get())
        ->addIndexColumn()
        ->make(true);
    }

    public function memberTransferForm()
    {
       $parrents = DB::select(DB::raw("SELECT * FROM (SELECT * FROM tree
            ORDER BY user_id) items_sorted,
           (SELECT @iv := :user_id) initialisation
           WHERE find_in_set(parent_id, @iv)
           AND length(@iv := concat(@iv, ',', id))"),
            array(
                'user_id' => Auth::user()->id,
            ));
        $members = DB::table('tree')
            ->select('members.name', 'members.id')
            ->join('members', 'tree.user_id', '=', 'members.id')
            ->get();
        return view('member.epin_transfer', compact('members'));
    }

    public function memberEpinTransfer(Request $request)
    {
        $this->validate($request, [
            'howEpin'       => 'required',
            'downlineUser'  => 'required',
        ]);
        $howEpin = $request->input('howEpin');
        $downlineUser = $request->input('downlineUser');
        // Fetch EPIN List 
        $epin = DB::table('epin')->where('alloted_to', Auth::user()->id)->where('status', 2)->count();
        if($howEpin < $epin){
            $allocate_to = DB::table('epin')
                ->where('alloted_to', Auth::user()->id)
                ->where('status', 2)
                ->take($howEpin)
                ->update([
                    'alloted_to' => $downlineUser,
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
            $member_name = DB::table('members')->where('id', $downlineUser)->value('name');
            return redirect()->back()->with('message', $howEpin.' EPIN is successfully transfered to '.$member_name.' !');
        }else{
            return redirect()->back()->with('error','Sorry! '.$howEpin.' EPIN is not available!');
        }
    }
}
