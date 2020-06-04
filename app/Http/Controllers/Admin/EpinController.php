<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use DataTables;
class EpinController extends Controller
{
    public function memEpinList(){
        return view('admin.epin');
    }

    public function memAddEpinForm(){
        return view('admin.add_epin_form');
    }

    public function memAddGenerateEpin(Request $request){
        $validatedData = $request->validate([
            'epin' => 'required',
        ]); 

       for ($i=0; $i < $request->input('epin'); $i++) { 
            $epin_insert = DB::table('epin')
                ->insertGetId([
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
    
            if($epin_insert){
                
                $epin = $this->randomNum($epin_insert);
                $epin_insert = DB::table('epin')
                    ->where('id', '=', $epin_insert)
                    ->update([
                        'epin' => $epin,
                    ]);
            }
       } 
        return redirect()->back()->with('message','Epin Generated Successfully');
    }

    public function ajaxGetEpinList()
    {    
        $query = DB::table('epin')
                ->leftjoin('members', 'epin.alloted_to', '=', 'members.id')
                // ->leftjoin('members', 'epin.used_by', '=', 'members.id')
                ->select('epin.*', 'members.name as alloted_to');
                // ->select('epin.*', 'members.name AS used_by');
                // return $query;
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

    function randomNum($epin_insert){
           // Available alpha caracters
           $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

           // generate a pin based on 2 * 7 digits + a random character
           $string = $characters[rand(0, strlen($characters) - 1)] . $characters[rand(0, strlen($characters)- 1)] ;

           $id_length = strlen((string)$epin_insert);
           $length = 6 - $id_length;
           $from_num = NULL;
           $to_num = NULL;
           $random_num = NULL;
           for ($i=0; $i < $length; $i++) { 
               $from_num .="1";
               $to_num .= "9";
           }
           if (!empty($from_num) && !empty($to_num)) {
               $random_num = rand($from_num, $to_num);
           }

           $epin = $string . $random_num . $epin_insert;
           return $epin;
    }

    
}
