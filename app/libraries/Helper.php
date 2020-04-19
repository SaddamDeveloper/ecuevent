<?php

class Helper
{
    public static function Status() {
        $order_status = DB::table('members')
            ->select('order_status')
            ->where('id', Auth::user()->id)->first();
        $token = rand(111111,999999);
        Session::put('product_page_token', $token);
        Session::save();
        if($order_status->order_status == 1){
            echo '<div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            You haven\'t purchased any product! Please <a href="'.route('member.product_page',['product_page_token'=>encrypt($token), 'user_id'=>encrypt(Auth::user()->id)]).'">purchase</a> it for more benefits!
            </div>';
        }

        $document_status = DB::table('members')
        ->select('document_u_status')
        ->where('id', Auth::user()->id)->first();
        $token = rand(111111,999999);
        Session::put('kyc_page_token', $token);
        Session::save();
        if($document_status->document_u_status == 2){
            echo '<div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            You haven\'t uploaded any documents! Please <a href="'.route('member.kyc_page',['kyc_page_token'=>encrypt($token), 'user_id'=>encrypt(Auth::user()->id)]).'">upload</a> it for further verification!
            </div>';
        }
    }
}