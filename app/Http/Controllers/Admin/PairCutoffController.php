<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class PairCutoffController extends Controller
{
    public function memPairCutoff(){
        return view('admin.pair_cut_off');
    }
    public function memPairTiming(){
        $table_data = DB::table('pair_timing')->paginate(10);
        return view('admin.pair_timing', compact('table_data'));
    }

    /**
     * Pair Timing Config
     */
    public function memAddPairTiming(Request $request){
        $validatedData = $request->validate([
            'from' => 'required',
            'to' =>  'required'
        ]);

        $times = DB::table('pair_timing')->count();

        if(DB::table('pair_timing')->count() < 4){
            $time_insert = DB::table('pair_timing')
            ->insertGetId([
                'name' => $request->input('name'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
                ]);
                
                if($time_insert){
                return redirect()->back()->with('message','Time has been set successfully!');
            }
        }else{
            return redirect()->back()->with('error',$times.' times already inserted!');
        }
    }

    public function memAddPairCutoff(Request $request){
        $validatedData = $request->validate([
            'mytext.*' => 'required|integer'
        ]);

        for ($i = 0; $i < count($request->mytext); $i++) {
            $mytext[] = [
                'cutoff' => $request->mytext[$i],
                'created_at'    => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ];
        }

        $cutoff_insert = DB::table('cutoff')
        ->insert($mytext);
            
        if($cutoff_insert){
            return redirect()->back()->with('message','Time has been set successfully!');
        }
    }

    public function memAjaxPairCutoff(){
        return datatables()->of(DB::table('cutoff')->orderBy('id','ASC')->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('admin.edit.mem_pair_cutoff', ['id' => encrypt($row->id)]).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="'.route('admin.delete.mem_pair_cutoff', ['id' => encrypt($row->id)]).'" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function editPairCutoff($eId){
        try{
            $id = decrypt($eId);
        }catch(DecryptException $e) {
            abort(404);
        }
      
        $cutoff = DB::table('cutoff')
            ->where('id', $id)
            ->first();
        return view('admin.edit_pair_cut_off', compact('cutoff'));
    }

    public function memUpdatePairCutoff(Request $request)
    {
        $request->validate([
            'cutOff' => 'required|numeric'
        ]);

        $cutoff = $request->input('cutOff');
        $id = $request->input('u_id');
        $cutoff_update = DB::table('cutoff')
            ->where('id', $id)
            ->update([
                'cutoff' => $cutoff,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()
            ]);
        
        if($cutoff_update){
            return redirect()->back()->with('message','Pair CutOFF Updated successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function memDeletePairCutoff($eId){
        try{
            $id = decrypt($eId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $deleteId = DB::table('cutoff')
            ->where('id', $id)
            ->delete();
            
        if($deleteId){
            return redirect()->back()->with('message','Deleted Successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
