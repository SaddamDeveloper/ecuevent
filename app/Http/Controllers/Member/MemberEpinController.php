<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\EpinRequest;
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
        return view('member.epin_transfer');
    }
}
