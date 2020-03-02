<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;

class MemberProductController extends Controller
{
    public function memProductList(){
        return view('admin.member_product.product_list');
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
        $image1 = null;
        $image2 = null;
        if($request->hasfile('image1'))
        {
            $image1_array = $request->file('image1');
            $image1 = $this->imageInsert($image_array);
        }
        if($request->hasfile('image2'))
        {
            $image1_array = $request->file('image2');
            $image2 = $this->imageInsert($image_array);
        }
        
    }

    function imageInsert($image){

        // $image = $request->file('img');
        $destination = base_path().'/public/member/product/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time())."-".$request->input('category_name')."."."$image_extension";
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/member/product/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);
    }
}
