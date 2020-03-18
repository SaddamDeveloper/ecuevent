<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class MatchingIncomeController extends Controller
{
    public function memMatchingIncomeForm(){
        $matching_income = DB::table('matching_income')->first();
        $matching_income_final = $matching_income->income;
        return view('admin.matching_income_form', compact('matching_income_final'));
    }

    public function memAddMatchingIncome(Request $request){
        $this->validate($request, [
            'matching_income'   => 'required|numeric'
        ]);
        
        $matching_income_insert_id = DB::table('matching_income')
            ->update([
                'income' => $request->input('matching_income'),
            ]);

        return redirect()->back()->with('message','Inserted Successfully');
    }
}
