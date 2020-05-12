<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ShoppingCategory;
use Carbon\Carbon;
use DataTables;
use Intervention\Image\Facades\Image;
use File;
use App\Model\ShoppingProduct;
class ShoppingProductController extends Controller
{
    public function shoppingProduct(){
        return view('admin.shopping_product');
    }

    public function addShoppingProduct(){
        $category = ShoppingCategory::get();
        return view('admin.add_shopping_product', compact('category'));
    }

    public function storeShoppingProduct(Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mrp' => 'required|min:1|numeric',
            'price'   => 'required|min:1|numeric'
        ]);

        $name = $request->input('name');
        $category = $request->input('category');
        $image = null;
        if($request->hasfile('main_image')){
            $image_array = $request->file('main_image');
            $image = $this->imageInsert($image_array, $request, 1);
        }
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        $short_desc = $request->input('short_desc');
        $long_desc = $request->input('long_desc');

        $shopping_product_insert = new ShoppingProduct;
        $shopping_product_insert->name = $name;
        $shopping_product_insert->category_id = $category;
        $shopping_product_insert->main_image = $image;
        $shopping_product_insert->mrp = $mrp;
        $shopping_product_insert->price = $price;
        $shopping_product_insert->short_desc = $short_desc;
        $shopping_product_insert->long_desc = $long_desc;

        $save = $shopping_product_insert->save();
        if($save){
            return redirect()->back()->with('message','Product Added Successfully!');
        }
    }

    public function ShoppingProductList(){
        return datatables()->of(ShoppingProduct::get())
        ->addIndexColumn()
        ->addColumn('category_name', function($row){
            if($row->id){
                $category_name = ShoppingProduct::find($row->id)->category->name;
            }
            return $category_name;
        })
        ->addColumn('main_image', function($row){
            if($row->main_image){
                $main_image = '<img src="product/thumb/'.$row->main_image.'"/>';
            }
            return $main_image;
        })
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.shopping_product_status', ['pId' => encrypt($row->id), 'status'=> encrypt(2)]).'" class="btn btn-danger">Disable</a>';
            }else{
                $action = '<a href="'.route('admin.shopping_product_status', ['pId' => encrypt($row->id), 'status'=> encrypt(1)]).'" class="btn btn-primary">Enable</a>';
            }
                $action .= '<a  href="'.route('admin.shopping_product_edit', ['id' => encrypt($row->id)]).'" class="btn btn-info">Edit</a>';
            return $action;
        })
        ->rawColumns(['action', 'category_name', 'main_image'])
        ->make(true);
    }

    public function ShoppingProductEdit($pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $product = ShoppingProduct::find($id);
        $category = ShoppingCategory::find($id);
        return view('admin.edit_shopping_product', compact('product'));
    }

    public function ShoppingProductStatus($pId,$statusId){
        try{
            $id = decrypt($pId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $shopping_product_status = ShoppingProduct::where('id', $id)
            ->update(['status' => $sId, 'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()]);
       if($shopping_product_status){
           return redirect()->back()->with('message','Status Updated Successfully!');
       }
    }

    public function ShoppingProductUpdate(Request $request, $pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
            'mrp' => 'required|min:1|numeric',
            'price'   => 'required|min:1|numeric'
        ]);
        
        $shopping_product = ShoppingProduct::find($id);
        $shopping_product_insert->name = $name;
        $shopping_product_insert->category_id = $category;
        $shopping_product_insert->main_image = $image;
        $shopping_product_insert->mrp = $mrp;
        $shopping_product_insert->price = $price;
        $shopping_product_insert->short_desc = $short_desc;
        $shopping_product_insert->long_desc = $long_desc;
        $update = $shopping_product->save();

        if($update){
            return redirect()->back()->with('message','Product Updated Successfully!');
        }

    }
    //SHOPPING CATEGORY
    public function shoppingCategory(){
        return view('admin.shopping_category');
    }

    public function addShoppingCategory(){
        return view('admin.add_shopping_category');
    }

    public function storeShoppingCategory(Request $request){
        $this->validate($request, [
            'category'   => 'required'
        ]);
        
        $shopping_category = new ShoppingCategory;
        $shopping_category->name = $request->input('category');
        $shopping_category->parent_id = NULL;
        $shopping_category->status = '1';
        $shopping_category->created_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();

        $save = $shopping_category->save();
        if($save){
            return redirect()->back()->with('message','Category Added Successfully!');
        }
    }

    public function shoppingCategoryList(){
        $category = ShoppingCategory::limit(10);
        return datatables()->of($category->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.shopping_category_status', ['pId' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger">Disable</a>';
            }else{
                $action = '<a href="'.route('admin.shopping_category_status', ['pId' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-primary">Enable</a>';
            }
                $action .= '<a  href="'.route('admin.shopping_category_edit', ['id' => encrypt($row->id)]).'" class="btn btn-info">Edit</a>';
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function ShoppingCategoryEdit($pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $category = ShoppingCategory::find($id);
        return view('admin.edit_shopping_category', compact('category'));
    }

    public function ShoppingCategoryUpdate(Request $request, $pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $this->validate($request, [
            'category'   => 'required'
        ]);
        
        $shopping_category = ShoppingCategory::find($id);
        $shopping_category->name = $request->input('category');
        $shopping_category->parent_id = NULL;
        $shopping_category->status = '1';
        $shopping_category->created_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();

        $update = $shopping_category->save();
        if($update){
            return redirect()->back()->with('message','Category Updated Successfully!');
        }

    }

    public function ShoppingCategoryStatus( $pId,$statusId){
        try{
            $id = decrypt($pId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $cutoff_update = ShoppingCategory::where('id', $id)
            ->update(['status' => $sId, 'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()]);
       if($cutoff_update){
           return redirect()->back()->with('message','Status Updated Successfully!');
       }
    }

    function imageInsert($image, Request $request, $flag){
        $destination = base_path().'/public/shopping/product/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time()).$flag.".".$image_extension;
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/shopping/product/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);

        return $image_name;
    }
}
