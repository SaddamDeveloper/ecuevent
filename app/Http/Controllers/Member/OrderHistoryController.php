<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class OrderHistoryController extends Controller
{
    public function ajaxGetOrderList(){
        $query = DB::table('member_joining_order')
        ->leftjoin('members', 'member_joining_order.user_id', '=', 'members.id')
        ->select('member_joining_order.*', 'members.name as user_name')
        ->where('members.id', Auth::user()->id);
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('image', function($row){
                $thumb = '<img src="'.asset('member/product/thumb/'.$row->image1).'" height="80" width="80"> ';
                return $thumb;
            })
            ->rawColumns(['image'])
            ->make(true);
    }
}
