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
            ->make(true);
    }
}
