<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\ImportantNotice;
use Illuminate\Support\Str;
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

    public function importantNoticePage()
    {
        return view('admin.important_notice');
    }

    public function importantNotice(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);   
        
        $important_notice = new ImportantNotice;
        $important_notice->title = $request->input('title');
        $important_notice->description = $request->input('description');

        if($important_notice->save()){
            return redirect()->back()->with('message', 'Important Notice Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function getNoticeList()
    {
            $query = ImportantNotice::orderBy('id','desc');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('description', function($row){
                $description = Str::words($row->description, 6, ' ...');
                return $description;
            })
            ->addColumn('action', function($row){
                   $btn = '
                    <a href="'.route('admin.notice_view', ['id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
                   ';
    
                   if($row->status == '1'){
                        $btn .= '<a href="'.route('admin.notice_status', ['id' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>';
                        return $btn;
                    }else{
                        $btn .='<a href="'.route('admin.notice_status', ['id' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
                        return $btn;
                    }
                 return $btn;
            })
            ->rawColumns(['description', 'action'])
            ->make(true);            $query = ImportantNotice::orderBy('id','desc');
            return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('description', function($row){
                $description = Str::words($row->description, 6, ' ...');
                return $description;
            })
            ->addColumn('action', function($row){
                   $btn = '
                    <a href="'.route('admin.notice_view', ['id' => encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
                   ';
    
                   if($row->status == '1'){
                        $btn .= '<a href="'.route('admin.notice_status', ['id' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>';
                        return $btn;
                    }else{
                        $btn .='<a href="'.route('admin.notice_status', ['id' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
                        return $btn;
                    }
                 return $btn;
            })
            ->rawColumns(['description', 'action'])
            ->make(true);
    }

    public function viewNotice($nId)
    {
        try {
            $id = decrypt($nId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $notice = ImportantNotice::findOrFail($id);
        return view('admin.view_notice', compact('notice'));
    }

    public function noticeStatus($nId, $statusId)
    {
        try {
            $id = decrypt($nId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $notice = ImportantNotice::findOrFail($id);
        if($notice->fill(array('status' => $sId))->save()){
            return redirect()->back()->with('message', 'Notice Status Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function feedBack()
    {
        return view('admin.feedback');
    }
}
