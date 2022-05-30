<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Str;
use App\Http\Requests;
use Mail;
use Session;
use Cart;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Support\Facades\Redirect;
session_start();

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index( Request $request) {
        
        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }else {
             DB::table('tbl_cart')->delete();   
           }
        
        // seo meta
        // $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        // $meta_keywords = "Shop Nội Thất";
        // $meta_title="furniture";
        // $url_canonical = $request->url();
        
        $cate_product= DB::table('tbl_category_product')->where('categor_status','1')->whereNotIn('categor_id',[5])->orderby('categor_id','desc')->limit(6)->get();
        $all_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->where('product_status','1')->inRandomOrder()->limit(12)->get();
        
        $all_product2= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->inRandomOrder()->limit(16)->get();
        
        $set_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->where('categor_id','5')->inRandomOrder()->limit(16)->get();
        
        $wedding_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->where('categor_id','6,3')->inRandomOrder()->limit(16)->get();
        
        return view('pages.home')->with('category', $cate_product)->with('product2',$all_product2)->with('set_product',$set_product)
        ->with('wedding_product',$wedding_product)->with('product',$all_product);
        //->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical)
    }
    public function contact( Request $request) {
        
        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }else {
             DB::table('tbl_cart')->delete();   
           }
        
        // seo meta
        $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        $meta_keywords = "Shop Nội Thất";
        $meta_title="furniture";
        $url_canonical = $request->url();
        
        $cate_product= DB::table('tbl_category_product')->where('categor_status','1')->orderby('categor_id','desc')->get();
        $all_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->inRandomOrder()->limit(16)->get();
        $all_product2= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->inRandomOrder()->limit(16)->get();
        
        return view('pages.contact')->with('category', $cate_product)->with('product2',$all_product2)->with('product',$all_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
        
    }

    public function search(Request $request) {
        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }
        
        $keysearch = $request-> keysearch;
        $cate_product= DB::table('tbl_category_product')->where('categor_status','1')->orderby('categor_id','desc')->get();
        $search_product= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')->where('product_status','1')->where('product_name','like','%'.$keysearch.'%')->limit(8)->get();

        $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        $meta_keywords = "Shop Nội Thất";
        $meta_title="furniture";
        $url_canonical = $request->url();
        
        return view('pages.search')->with('category', $cate_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);;
    }

    public function my_order(Request $request) {
        $customer_id = Session::get('customer_id');
        $customer= DB::table('tbl_customer')->where('customer_id',$customer_id )->get();
        $meta= DB::table('tbl_customer')
        ->join('tbl_order','tbl_customer.customer_id','=','tbl_order.customer_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        $meta_keywords = $val->customer_name;
        $meta_title="furniture";
        $url_canonical = $request->url();
       }
       $processing_order= DB::table('tbl_order')->where('tbl_order.customer_id',$customer_id )
       ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
       ->join('tbl_order_status','tbl_order_status.order_status_id','=','tbl_order.order_status_id')
       ->select('tbl_order.*','tbl_order_status.*','tbl_customer.customer_name')->where('tbl_order.order_status_id','1')
       ->orderby('tbl_order.order_id','desc') ->get();

       $delivered_order= DB::table('tbl_order')->where('tbl_order.customer_id',$customer_id )
       ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
       ->join('tbl_order_status','tbl_order_status.order_status_id','=','tbl_order.order_status_id')->where('tbl_order.order_status_id','2')
       ->select('tbl_order.*','tbl_order_status.*','tbl_customer.customer_name')
       ->orderby('tbl_order.order_id','desc') ->get();

       $cancel_order= DB::table('tbl_order')->where('tbl_order.customer_id',$customer_id )
       ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
       ->join('tbl_order_status','tbl_order_status.order_status_id','=','tbl_order.order_status_id')->where('tbl_order.order_status_id','3')
       ->select('tbl_order.*','tbl_order_status.*','tbl_customer.customer_name')
       ->orderby('tbl_order.order_id','desc') ->get();

       $adrress_billing=DB::table('tbl_billing')
           ->join('tbl_customer','tbl_customer.customer_id','=','tbl_billing.customer_id')->where('tbl_billing.customer_id',$customer_id)->get(); 

        return view('pages.my_order')->with('info',$customer)->with('address_billing',$adrress_billing)->with('processing_order',$processing_order)->with('delivered_order',$delivered_order)->with('cancel_order',$cancel_order)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
    }

    public function view_processing(Request $request, $orderid) {
        $meta= DB::table('tbl_customer')
        ->join('tbl_order','tbl_customer.customer_id','=','tbl_order.customer_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        $meta_keywords = $val->customer_name;
        $meta_title="furniture";
        $url_canonical = $request->url();
       }

       $order_by_id= DB::table('tbl_order')->where('tbl_order.order_id',$orderid)
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_billing','tbl_billing.billing_id','=','tbl_order.billing_id')
        ->join('tbl_detail','tbl_order.order_id','=','tbl_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_billing.*','tbl_detail.*')->first();
        $detail_order=DB::table('tbl_detail')->where('order_id',$orderid)->orderby('detail_id','desc')->get();
        return view('pages.my_processing')->with('order_by_id',$order_by_id)->with('detail_order',$detail_order)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);

    }
    public function cancel_order($orderid) {
        DB::table('tbl_order')->where('order_id',$orderid)->update(['order_status_id'=>3]);
        
        return Redirect::to('/my_order');
    }

    public function view_delivered(Request $request, $orderid) {
        $meta= DB::table('tbl_customer')
        ->join('tbl_order','tbl_customer.customer_id','=','tbl_order.customer_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        $meta_keywords = $val->customer_name;
        $meta_title="furniture";
        $url_canonical = $request->url();
       }

       $order_deli_view= DB::table('tbl_order')->where('tbl_order.order_id',$orderid)
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_billing','tbl_billing.billing_id','=','tbl_order.billing_id')
        ->join('tbl_detail','tbl_order.order_id','=','tbl_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_billing.*','tbl_detail.*')->first();
        $detail_order_deli=DB::table('tbl_detail')->where('order_id',$orderid)->orderby('detail_id','desc')->get();
        return view('pages.my_delivered')->with('order_by_id',$order_deli_view)->with('detail_order',$detail_order_deli)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);

    }

    public function view_cancel(Request $request, $orderid) {
        $meta= DB::table('tbl_customer')
        ->join('tbl_order','tbl_customer.customer_id','=','tbl_order.customer_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
        $meta_keywords = $val->customer_name;
        $meta_title="furniture";
        $url_canonical = $request->url();
       }

       $order_deli_cancel= DB::table('tbl_order')->where('tbl_order.order_id',$orderid)
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_billing','tbl_billing.billing_id','=','tbl_order.billing_id')
        ->join('tbl_detail','tbl_order.order_id','=','tbl_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_billing.*','tbl_detail.*')->first();
        $detail_order_cancel=DB::table('tbl_detail')->where('order_id',$orderid)->orderby('detail_id','desc')->get();
        return view('pages.my_cancel')->with('order_by_id',$order_deli_cancel)->with('detail_order',$detail_order_cancel)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);

    }
    public function edit_customer(Request $request, $customer_id){
        $meta= DB::table('tbl_customer')
        ->join('tbl_order','tbl_customer.customer_id','=','tbl_order.customer_id')->get();
        foreach($meta as $key => $val) {
            $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
            $meta_keywords = $val->customer_name;
            $meta_title="furniture";
            $url_canonical = $request->url();
           }
        $edit_account = DB::table('tbl_customer')->where('customer_id',$customer_id)->get();
        return view('pages.edit_customer')->with('edit_account',$edit_account)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
    }
    public function update_customer(Request $request, $customer_id) {
        
        $data=array();
        $data['customer_name'] = $request->name_customer;
       
        $data['customer_phone'] = $request->phone_customer;
        $data['customer_email'] = $request->email_customer;
        $get_image = $request ->file('customer_img');
        $get_email=DB::table('tbl_customer')->where('tbl_customer.customer_email',$data['customer_email'])->exists();
        if($get_email && $get_email != $data['customer_email']) {
            Session::put('mess1','Email already exists*. Please Re-Register To Continue ');   
            Session::put('mess2','Email already exists*');
            return back()->withInput();
            }else{
            
            if($get_image) {
                $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
                $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
                $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
                $get_image -> move('public/uploads/customer',$new_image);
                $data['customer_img'] = $new_image;
                
                DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data);
                
                return Redirect::to('/my_order');
            }
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data);
            Session::put('customer_id',$customer_id);
            Session::put('customer_name',$request->name_customer);
            return Redirect::to('/my_order');
            
            }
   
        }

        public function change_password(Request $request, $customer_id) {
            $meta= DB::table('tbl_customer')
        ->join('tbl_order','tbl_customer.customer_id','=','tbl_order.customer_id')->get();
        foreach($meta as $key => $val) {
            $meta_desc = "Buôn bán những vật dụng nội thất tốt-đẹp-tiết kiệm";
            $meta_keywords = $val->customer_name;
            $meta_title="furniture";
            $url_canonical = $request->url();
           }
            $edit_account = DB::table('tbl_customer')->where('customer_id',$customer_id)->get(); 
        return view('pages.edit_customer')->with('edit_account',$edit_account)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
        }

        public function update_password(Request $request, $customer_id) {
        
        $data_pass=array();
        $data_pass['customer_password']=md5($request->password_customer) ;
        $get_pass=DB::table('tbl_customer')->where('tbl_customer.customer_password',$data_pass['customer_password'])->exists();
        if($get_pass){
           $data_pass['customer_password']= md5( $request->new_password);
            DB::table('tbl_customer')->where('customer_id',$customer_id)->update($data_pass);
            return Redirect::to('/my_order');

        }else{
            Session::put('mess3','Incorrect password*');
            return back()->withInput();
        }
        
        
        
        }
        /// Quên mật khẩu
        public function forget_password() {
            return view('pages.forget_pass');
        }
        public function recover_password( Request $request) {
            $data = $request-> all();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            $title_mail = "Lấy lại mật khẩu furniture.com".' '.$now;
            $customer =Customer::where('customer_email','=',$data['customer_email'])->get();
            foreach($customer as $key => $value) {
                $customer_id = $value->customer_id;
            }
            if($customer){
                $count_customer = $customer ->count();
                if($count_customer ==0) {
                    return redirect()->back()->with('error','Email chưa được đăng ký để khôi phục mật khẩu!');
                }else {
                    $token_random = Str::random();
                    $customer = Customer::find($customer_id);
                    $customer -> customer_token = $token_random;
                    $customer-> save();
    
                    $to_email = $data['customer_email'];
                    $link_reset_pass = url('/update_new_pass?email='.$to_email.'&token='.$token_random);
    
                    $data= array('name'=>$title_mail,'body'=>$link_reset_pass,'email'=>$data['customer_email']);
    
                    Mail::send('pages.forget_mail',['data'=>$data],function($message) use ($title_mail, $data)
                {
                    $message -> to($data['email'])->subject($title_mail);
                    $message -> from($data['email'],$title_mail);
                });
                return redirect()->back()->with('message','Email sent successfully, please go to your email to reset your password!');
                }
            }
        }

        public function update_new_password() {
            return view('pages.new_pass');
        }
        public function reset_new_password(Request $request) {
            $data = $request-> all();
            $token_random = Str::random();
            $customer_pass = customer::where('customer_email','=',$data['email'])->where('customer_token','=',$data['token'])->get();
            $count = $customer_pass ->count();
            if($count>0) {
                foreach($customer_pass as $key => $customer) {
                    $customer_id = $customer ->customer_id;
                }
               $reset = customer::find($customer_id);
               $reset->customer_password = md5($data['customer_pass']);
               $reset->customer_token = $token_random;
               $reset->save();
               return redirect('login_customer')->with('message','*Password vừa được cập nhật mới. Vui lòng đăng nhập để tiếp tục ');
            }else{
                return redirect('forget-pass')->with('error','*Vui lòng nhập lại email vì liên kết đã quá hạn');
            }
        }

}
