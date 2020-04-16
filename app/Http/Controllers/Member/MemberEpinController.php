<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

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
}
