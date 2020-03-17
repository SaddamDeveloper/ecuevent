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
}
