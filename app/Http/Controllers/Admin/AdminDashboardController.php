<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function state(){
        return view('admin.state');
    }

    public function addState(Request $request){
        $this->validate($request, [
            'state'   => 'required'
        ]);

        $add = DB::table('state')
            ->insertGetId([
                'state' => $request->input('state'),
                'status' => 1,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);

        if($add){
            return redirect()->back()->with('message', 'State Successfully Added');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function ajaxGetStateList(){
        $state = DB::table('state')
        ->orderBy('id','desc');

        if (request()->ajax()) {
            return datatables()->of($state->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->status == '1'){
                    $btn = '<a href="'.route('admin.state_status', ['id' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>';
                    return $btn;
                }else{
                    $btn ='<a href="'.route('admin.state_status', ['id' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
                    return $btn;
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }else{
            return view('admin.state', compact('state'));
        }
    }

    public function stateStatus($stateId, $statusId){
        try {
            $id = decrypt($stateId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $status_state = DB::table('state')
        ->where('id', $id)
        ->update([
            'status' => $sId,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
        ]);

        if($sId == 1){
            return redirect()->back()->with('message', 'State Activated Successfully!');
        }else{
            return redirect()->back()->with('error', 'State Deactivated Successfully');
        }

    }

    public function city(){
        return view('admin.city');
    }

    public function addCity(Request $request){
        $this->validate($request, [
            'city'   => 'required'
        ]);

        $add = DB::table('city')
            ->insertGetId([
                'city' => $request->input('city'),
                'status' => 1,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);

        if($add){
            return redirect()->back()->with('message', 'City Successfully Added');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function ajaxGetCityList(){
        $city = DB::table('city')
        ->orderBy('id','desc');
        if (request()->ajax()) {
            return datatables()->of($city->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                if($row->status == '1'){
                    $btn = '<a href="'.route('admin.city_status', ['id' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger btn-sm"><i class="fa fa-power-off"></i></a>';
                    return $btn;
                }else{
                    $btn ='<a href="'.route('admin.city_status', ['id' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>';
                    return $btn;
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }else{
            return view('admin.city', compact('city'));
        }
    }

    public function cityStatus($cityId, $statusId){
        try {
            $id = decrypt($cityId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $status_city = DB::table('city')
        ->where('id', $id)
        ->update([
            'status' => $sId,
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
        ]);

        if($sId == 1){
            return redirect()->back()->with('message', 'City Activated Successfully!');
        }else{
            return redirect()->back()->with('error', 'City Deactivated Successfully');
        }

    }
}
