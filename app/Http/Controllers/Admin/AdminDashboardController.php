<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    public function index(){
        $total_members = DB::table('members')->count();
        $total_products = DB::table('member_product')->count();
        $total_member_wallet_balance = DB::table('wallet')->sum('amount');

        $latest_members = DB::table('members')
            ->orderBy('id','desc')
            ->limit(10)
            ->get();
        // dd($latest_members);
        return view('admin.dashboard', compact('total_members', 'total_products', 'total_member_wallet_balance', 'latest_members'));
    }
}
