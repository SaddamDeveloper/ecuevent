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
}
