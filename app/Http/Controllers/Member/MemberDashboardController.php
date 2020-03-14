<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;

class MemberDashboardController extends Controller
{
    public function index(){
        return view('member.dashboard');
    }

    public function profile(){
        return view('member.profile');
    }

    public function addNewMemberForm(){
        return view('member.registration.member_registration_form');
    }
    
    public function memberList(){
        return view('member.registration.member_list');
    }

    public function addEpinForm($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('epin_page_token') && !empty(Session::get('epin_page_token'))) {
            $session_token = Session::get('epin_page_token');
            if ( $session_token == $token) {
                return view('member.registration.add_epin_form');
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
       
    }

    public function addTermsForm($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('terms_page_token') && !empty(Session::get('terms_page_token'))) {
            $session_token = Session::get('terms_page_token');
            if ( $session_token == $token) {
                return view('member.registration.add_terms_form');
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
       
    }
    
    public function productPage($token,$user_id){
        try{
            $token = decrypt($token);
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('product_page_token') && !empty(Session::get('product_page_token'))) {
            $session_token = Session::get('product_page_token');
            if ( $session_token == $token) {
                $products = DB::table('member_product')->take(3)->get();
                return view('member.registration.product_page', compact('products','user_id'));
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
       
    }

    public function kycPage($token, $user_id){
        try{
            $token = decrypt($token);
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('kyc_page_token') && !empty(Session::get('kyc_page_token'))) {
            $session_token = Session::get('kyc_page_token');
            if ( $session_token == $token) {
               
                // $products = DB::table('member_product')->take(3)->get();
                return view('member.registration.kyc_page', compact('user_id'));
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function finishPage($token){
        try{
            $token = decrypt($token);
        }catch(DecryptException $e) {
            abort(404);
        }

        if (Session::has('finish_page_token') && !empty(Session::get('finish_page_token'))) {
            $session_token = Session::get('finish_page_token');
            if ( $session_token == $token) {
                $delete_previous_session = session()->forget('kyc_page_token');
                $success = 'Registration Successfull';
                return view('member.registration.finish_page', compact('success'));
            } else {
                abort(404);
            }
        }else{
            abort(404);
        }
    }
}
