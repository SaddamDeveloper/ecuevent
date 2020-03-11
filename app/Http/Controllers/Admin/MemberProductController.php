<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;
use DB;
use DataTables;

class MemberProductController extends Controller
{
    public function memProductList(){
        $query = DB::table('member_product')->paginate(10);
        return view('admin.member_product.product_list')->with('tabledatas', $query);
    }

    public function memAddProductForm(){
        return view('admin.member_product.add_product_form');
    }

    public function memAddNewProduct(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        // return $request;
        $name = $request->input('name');
        $price = $request->input('price');
        $image1 = null;
        $image2 = null;
        if($request->hasfile('image1'))
        {
            $image1_array = $request->file('image1');
            $image1 = $this->imageInsert($image1_array, $request, 1);
        }
        if($request->hasfile('image2'))
        {
            $image2_array = $request->file('image2');
            $image2 = $this->imageInsert($image2_array, $request, 2);
        }

        // return $image1;
        $product_insert = DB::table('member_product')
                        ->insertGetId([
                            'name' => $name,
                            'price' => $price,
                            'image1' => $image1,
                            'image2' => $image2,
                            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);

        if($product_insert){
            
            return redirect()->back()->with('message','Product Added Successfully');
        }else{
             return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        } 
    }

    function imageInsert($image, Request $request, $flag){
        // $image = $request->file('img');
        $destination = base_path().'/public/member/product/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time()).$flag.".".$image_extension;
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/member/product/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);

        return $image_name;
    }

    public function editMemberProduct($id){
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $member = DB::table('member_product')->where('id',$id)->first();
        return view('admin.member_product.edit_product_form', compact('member'));
    }

    public function updateMemberProduct(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $name = $request->input('name');
        $price = $request->input('price');
        $image1 = null;
        $image2 = null;
        if($request->hasfile('image1'))
        {
            $image1_array = $request->file('image1');
            $image1 = $this->imageInsert($image1_array, $request);
        }
        if($request->hasfile('image2'))
        {
            $image2_array = $request->file('image2');
            $image2 = $this->imageInsert($image2_array, $request);
        }

        $product_insert = DB::table('member_product')
        ->update([
            'name' => $name,
            'price' => $price,
            'image1' => $image1,
            'image2' => $image2,
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);

        if($product_insert){

        return redirect()->back()->with('message','Product Updated Successfully');
        }else{
        return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        } 
    }

    public function deleteMemberProduct($id){
        try {
            $decrypted = decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }
        $query = DB::table('member_product')->where('id',$decrypted)->delete();
        if($query){
            return redirect()->back()->with('message','Product Deleted Successfully');
        }else{
        return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        } 
    }
}
