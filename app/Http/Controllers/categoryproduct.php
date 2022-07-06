<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class categoryproduct extends Controller
{
    public function Authadmin() {
        $admin_id= Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
        
    }

    public function add_category_product() {
        $this->Authadmin();
        // return view('admin.add_category_product');
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.add_category_product')->with('all_category_product',$all_category_product);
        return view('admin.admin_layout')->with('admin.add_category_product',$manager_category_product);
    }
    
    public function save_category_product(Request $request) {
        $this->Authadmin();
        $data = array();
        $data['categor_name'] = $request ->category_product_name;
        $data['categor_desc'] = $request ->category_product_desc;
        $data['meta_keywords'] = $request ->category_product_keywords;
        $data['categor_status'] = $request ->category_product_status;
        $data['categor_image'] = $request ->category_product_image;
        //Thêm file ảnh vào thư mục khi mình tự chọn ảnh ngoài
        $get_image = $request ->file('category_product_image');
        if($get_image) {
            $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
            $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
            $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
            $get_image -> move('public/uploads/category',$new_image);
            $data['categor_image'] = $new_image;
            DB::table('tbl_category_product')->insert($data);
            Session::put('message','Thêm danh mục sản phẩm thành công');
            return Redirect::to('/add-category-product');
        }//
        $data['categor_image'] = '';
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
        
    }
//Kích hoạt hoặc ẩn sản phẩm
    public function unactive_category_product($category_product_id) {
        $this->Authadmin();
        DB::table('tbl_category_product')->where('categor_id',$category_product_id)->update(['categor_status'=>1]);
        Session::put('mess','Kích hoạt sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }
    public function active_category_product($category_product_id) {
        $this->Authadmin();
        DB::table('tbl_category_product')->where('categor_id',$category_product_id)->update(['categor_status'=>0]);
        Session::put('mess','Không kích hoạt sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }//
     public function edit_category_product( $category_product_id) {
        $this->Authadmin();
        $edit_category_product = DB::table('tbl_category_product')->where('categor_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin.admin_layout')->with('admin.edit_category_product',$manager_category_product);
     }
     public function update_category_product (Request $request,$category_product_id) {
        $this->Authadmin();
        $data1 = array();
        $data1['categor_name'] = $request ->category_product_name;
        $data1['categor_desc'] = $request ->category_product_desc;
        $data1['meta_keywords'] = $request ->category_product_keywords;
        $get_image = $request ->file('edit_category_product_image');
        if($get_image) {
            $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
            $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
            $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
            $get_image -> move('public/uploads/category',$new_image);
            $data1['categor_image'] = $new_image;
            DB::table('tbl_category_product')->where('categor_id',$category_product_id)->update($data1);
            Session::put('mess2','Đã sửa sản phẩm thành công');
            return Redirect::to('/add-category-product');
        }//
        
        DB::table('tbl_category_product')->where('categor_id',$category_product_id)->update($data1);
        Session::put('mess2','Đã sửa sản phẩm thành công');
        return Redirect::to('/add-category-product');
     }

     public function delete_category_product($category_product_id) {
        $this->Authadmin();
        DB::table('tbl_category_product')->where('categor_id',$category_product_id)->delete();
        Session::put('mess2','Bạn vừa xóa danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
     }

     // Show danh mục sản phẩm
     public function show_category_product(Request $request,$category_id) {
        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }
        
        $cate_name = DB::table('tbl_category_product')->where('tbl_category_product.categor_id',$category_id)->limit(1)->get();
        $category_all = DB::table('tbl_category_product')->where('categor_status','1')->whereNotIn('tbl_category_product.categor_id',[$category_id])->limit(6)->inRandomOrder()->get();
        $all_cate_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->where('product_status','1')->get();
       foreach($all_cate_product as $key => $val) {
        $meta_desc = $val->categor_desc;
        $meta_keywords = $val->meta_keywords;
        $meta_title=$val->categor_name;
        $url_canonical = $request->url();
       }
       
        $seller_product= DB::table('tbl_product')->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->inRandomOrder()->limit(16)->get();
        return view('pages.show_category_product')->with('show_category_product', $all_cate_product)->with('category_name',$cate_name)->with('category_all',$category_all)->with('seller',$seller_product)
        ->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);



     }
}
