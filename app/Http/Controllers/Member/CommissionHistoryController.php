<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class CommissionHistoryController extends Controller
{
    public function ajaxGetCommissionList(){
        $query = DB::table('commission_history')
        ->leftjoin('members', 'commission_history.user_id', '=', 'members.id')
        ->select('commission_history.*', 'members.name as user_name')
        ->where('members.id', Auth::user()->id);
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->make(true);
    }
}
