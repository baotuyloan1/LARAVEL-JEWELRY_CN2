<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class Cartcontroller extends Controller
{
    // public function add_cart(Request $request){
    //     $data = $request->all();
       
    //     //session_id: là khi mỗi sản phẩm mình thêm vào thì sẽ tạo ra 1 session_id. để thuận lợi khi xóa, sửa
    //     $session_id = substr(md5(microtime()),rand(0,26),5);
    //     $cart = Session::get('cart'); // tạo 1 session cart
    //     if($cart==true){
    //         $is_avaiable = 0; // xem biến đó tồn tại chưa
    //         foreach($cart as $key => $val) {
    //             if($val['product_id']== $data['product_id']){
    //                 $is_avaiable++;
    //             }
    //         }
    //         if($is_avaiable == 0){
    //             $cart[] = array(
    //                 'session_id'=>$session_id,
    //                 'product_name'=> $data['cart_product_name'],
    //                 'product_id'=>$data['cart_product_id'],
    //                 'product_price'=>$data['cart_product_price'],
    //                 'product_qty'=>$data['cart_product_qty'],
    //                 'product_image'=>$data['cart_product_image'],
    //             );
    //             Session::put('cart',$cart);
    //         }
    //     }else {
    //         $cart[] = array(
    //             'session_id'=>$session_id,
    //             'product_name'=> $data['cart_product_name'],
    //             'product_id'=>$data['cart_product_id'],
    //             'product_price'=>$data['cart_product_price'],
    //             'product_qty'=>$data['cart_product_qty'],
    //             'product_image'=>$data['cart_product_image'],
    //         );
    //         // lấy tất cả những gì gửi qua thêm vào cart khi click add to cart
    //     Session::put('cart',$cart);
    //     Session::save();
    //     }
        
        
    // }

    public function save_cart(Request $request) {

        $productId = $request->productid_hidden;
        $quantity= $request ->quantity;
        $product_info=DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_id',$productId)->first();
       
        $data['id']= $product_info->product_id;
        $data['qty']= $quantity;
        $data['name']= $product_info->product_name;
        if($product_info->discount_percent>0){
            $price=(($product_info->product_price)*(100-($product_info->discount_percent)))/100;
            $data['price']= $price;
        }else{
            $data['price']= $product_info->product_price;
        }
        
        $data['weight']= '123';
        $data['options']['image']= $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/show_cart');
         //Cart::destroy();

        //Lưu giỏ hàng vào database
        //insert_cart
        // $content = Cart::content();
        // foreach($content as $v_content){
        // $cart_data= array();    
        // $cart_data['customer_id'] = Session::get('customer_id');
        // $cart_data['product_id'] = $v_content->id;
        // $cart_data['product_name'] = $v_content->name;
        // $cart_data['product_price'] = $v_content->price;
        // $cart_data['product_sales_quantity'] = $v_content->qty;
        // $cart_data['status'] = 'Chưa thanh toán';
        // DB::table('tbl_cart')->insertGetId($cart_data);
        // }
        
        
        
        // Sau khi bấm thêm vào giỏ hàng thì nó dẫn đến đường dẫn save_cart (Thực hiện shopping cart)
        // Sau đó dẫn tới đường dẫn show_cart đến trang pages.cart
        
    }
    // public function cart(Request $request) {
        
    //     $cate_product= DB::table('tbl_category_product')->where('categor_status','1')->orderby('categor_id','desc')->get();
    //     $best_seller= DB::table('tbl_product')->where('product_status','1')->inRandomOrder()->limit(16)->get();
        
        
    //     foreach($cate_product as $key => $val) {
    //         $meta_desc = $val->categor_desc;
    //         $meta_keywords = $val->meta_keywords;
            
    //        }
    //        foreach($best_seller as $key => $val2) {
            
    //         $meta_title=$val2->product_name;
    //         $url_canonical = $request->url();
    //        }
    //        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
    //        if($result) {
    //         Cart::destroy();
    //        }
    //        $content = Cart::content();
    //         foreach($content as $v_content){
    //         $cart_data= array();    
    //         $cart_data['customer_id'] = Session::get('customer_id');
    //         $cart_data['product_id'] = $v_content->id;
    //         $cart_data['product_name'] = $v_content->name;
    //         $cart_data['product_price'] = $v_content->price;
    //         $cart_data['product_sales_quantity'] = $v_content->qty;
    //         $cart_data['status'] = 0;
    //         DB::table('tbl_cart')->insertGetId($cart_data);
    //         }

           
    //     return view('pages.cart_ajax')->with('category', $cate_product)->with('best_seler',$best_seller)
    //     ->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
    // }


    public function show_cart(Request $request) {
        
        $cate_product= DB::table('tbl_category_product')->where('categor_status','1')->orderby('categor_id','desc')->get();
        $best_seller= DB::table('tbl_product')->where('product_status','1')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->inRandomOrder()->limit(16)->get();
        
        
        foreach($cate_product as $key => $val) {
            $meta_desc = $val->categor_desc;
            $meta_keywords = $val->meta_keywords;
            
           }
           foreach($best_seller as $key => $val2) {
            
            $meta_title=$val2->product_name;
            $url_canonical = $request->url();
           }
           $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
           }
           $content = Cart::content();
            foreach($content as $v_content){
            $cart_data= array();    
            $cart_data['customer_id'] = Session::get('customer_id');
            $cart_data['product_id'] = $v_content->id;
            $cart_data['product_name'] = $v_content->name;
            $cart_data['product_price'] = $v_content->price;
            $cart_data['product_sales_quantity'] = $v_content->qty;
            $cart_data['status'] = 0;
            DB::table('tbl_cart')->insertGetId($cart_data);
            }

           
        return view('pages.cart')->with('category', $cate_product)->with('best_seler',$best_seller)
        ->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
    }
    public function delete_cart($rowId) {
        Cart::update($rowId,0);
        return Redirect::to('/show_cart');
    }

    public function update_product(Request $request) {
        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }else {
             DB::table('tbl_cart')->delete(); 
             $rowId=$request->rowId_cart;
             $qty1=$request->cart_quantity;
            Cart::update($rowId,$qty1);  
           }
        // $rowId=$request->rowId_cart;
        // $qty1=$request->cart_quantity;
        // Cart::update($rowId,$qty1);
        return Redirect::to('/show_cart');
    }

    
}
