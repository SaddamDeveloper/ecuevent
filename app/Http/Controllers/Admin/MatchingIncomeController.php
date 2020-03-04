<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class MatchingIncomeController extends Controller
{
    public function memMatchingIncomeForm(){
        return view('admin.matching_income_form');
    }

    public function memAddMatchingIncome(Request $request){
        $this->validate($request, [
            'matching_income'   => 'required|numeric'
        ]);
 
            $matching_income_insert_id = DB::table('matching_income')
            ->insertGetId([
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);  
            
            if($matching_income_insert_id){

                $matching_income_insert_id = DB::table('matching_income')
                    ->where('id', '=', $matching_income_insert_id)
                    ->update([
                        'income' => $request->input('matching_income'),
                    ]);
            }
            return redirect()->back()->with('message','Inserted Successfully');
    }
}
