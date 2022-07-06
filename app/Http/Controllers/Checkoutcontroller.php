<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Cart;
use App\Models\Customer;
use App\Models\Billing;
session_start();
use Carbon\Carbon;

class Checkoutcontroller extends Controller
{

    
        //Hàm bảo mật, vào bất cứ trang gì cũng cần phải có admin, chớ k phải ghi đường dẫn là được
        public function Authadmin() {
            $admin_id= Session::get('admin_id');
            if($admin_id) {
                return Redirect::to('/dashboard');
            }else {
                return Redirect::to('/admin')->send();
            }
            
        }
    

    public function login_customer(Request $request) {
        $meta= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = $val->categor_desc;
        $meta_keywords = $val->meta_keywords;
        $meta_title="furniture";
        $url_canonical = $request->url();
       }
        return view('pages.login_customer')->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
    }
    public function register_customer(Request $request) {
                
                $request -> validate([
                    'password_customer'=>'required|min:8|max:30',
                    'customer_email'=>'required|email|max:255|unique:tbl_customer,customer_email',
                    'phone_customer'  =>'required|min:10|max:11'
                ],[
                    'customer_email.required' => 'Please input your email',
                    'customer_email.unique' => 'Email already exists in system*. Please Re-Register To Continue',
                    'customer_email.email' => 'You must enter the correct email as @gmail.com',
                    'password_customer.max' => 'Password must be not more than 30 characters',
                    'phone_customer.max' => 'Password must be not more than 11 characters',
                ]);

                $data=array();
                $data['customer_name'] = $request->name_customer;
                $data['customer_password'] = md5($request->password_customer);
                $data['customer_phone'] = $request->phone_customer;
                $data['customer_email'] = $request->customer_email;
                $data['created_at']=Carbon::now('Asia/Ho_Chi_Minh');
                $data['updated_at']=Carbon::now('Asia/Ho_Chi_Minh');
                
                
                    if(DB::table('tbl_customer')->where('tbl_customer.customer_email',$data['customer_email'])->exists()) {
                    Session::put('mess1','Email already exists*. Please Re-Register To Continue ');   
                    Session::put('mess2','Email already exists*');
                    return Redirect::to('/login_customer');
                    }else{
                    $customer_id= DB::table('tbl_customer')->insertGetId($data);
                    Session::put('mess3','You have successfully registered. Please Login To Continue ');
                    Session::put('customer_id',$customer_id);
                    Session::put('customer_name',$request->name_customer);
                    return Redirect::to('/login_customer');
                    }
           
    }
    public function checkout_buy(Request $request) {
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

        
        $customer_id= Session::get('customer_id');
        $meta= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = $val->categor_desc;
        $meta_keywords = $val->meta_keywords;
        $meta_title=$val->categor_name;
        $url_canonical = $request->url();
       }
            $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
            if($result) {
                Cart::destroy();
                DB::table('tbl_cart')->delete();
            }
           $adrress_billing=DB::table('tbl_billing')
           ->join('tbl_customer','tbl_customer.customer_id','=','tbl_billing.customer_id')->where('tbl_billing.customer_id',$customer_id)->where('tbl_billing.billing_status','1')->get();   
           $cate_payment= DB::table('tbl_payment')->orderby('payment_id','desc')->get();
           $product=Cart::content()->count();
            if($product==NULL){
            return Redirect::to('/show_cart')->with('alert', 'You have no products in your shopping cart. Please select a product to continue!');
             
            }else{
            return view('pages.checkout')->with('cate_payment',$cate_payment)->with('address_billing',$adrress_billing)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
           }
        }
    public function checkout(Request $request) {
        
        $customer_id= Session::get('customer_id');
        $meta= DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->get();
       foreach($meta as $key => $val) {
        $meta_desc = $val->categor_desc;
        $meta_keywords = $val->meta_keywords;
        $meta_title=$val->categor_name;
        $url_canonical = $request->url();
       }
             
       $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }
           $adrress_billing=DB::table('tbl_billing')
           ->join('tbl_customer','tbl_customer.customer_id','=','tbl_billing.customer_id')->where('tbl_billing.customer_id',$customer_id)->get();   
           $cate_payment= DB::table('tbl_payment')->orderby('payment_id','desc')->get();
           $product=Cart::content()->count();
            if($product==NULL){
            return Redirect::to('/show_cart')->with('alert', 'You have no products in your shopping cart. Please select a product to continue!');
             
            }else{
            return view('pages.checkout')->with('cate_payment',$cate_payment)->with('address_billing',$adrress_billing)->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
           }
        }

    public function billing_checkout(Request $request) {
        $data=array();
        $data['billing_name'] = $request->name_billing;
        $data['customer_id'] = Session::get('customer_id');
        $data['billing_address'] = $request->address_billing;
        $data['billing_phone'] = $request->phone_billing;
        $data['billing_email'] = $request->email_billing;
        $data['billing_status'] = 1;
        
        $billing_id= DB::table('tbl_billing')->insertGetId($data);
        Session::put('billing_id',$billing_id);
        return Redirect::to('/checkout');
        
    }
    public function delete_billing($billing_id) {
        DB::table('tbl_billing')->where('billing_id',$billing_id)->update(['billing_status'=>0]);
        
        return Redirect::to('/checkout');
    }


    public function logout_customer() {
        Session::flush();
        return Redirect::to('/login_customer');
    }

    public function login(Request $request) {
        $email_acc = $request->email_account;
        $pass_acc = md5($request->password_account);
        $remember = $request->has('remember') ? true : false;
        $result = DB::table('tbl_customer')->where('customer_email',$email_acc) -> where('customer_password',$pass_acc)->first();
        if($result) {
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/home');
        }else {
            Session::put('mess','*The password or account is incorrect. Please re-enter');
            return Redirect::to('/login_customer');
        }
    }

    // Thanh Toán

    public function order_place(Request $request){
        
        
    
        // //get payment method
        // $data=array();
        // $data['payment_method'] = $request->payment_option;
        // $data['payment_status'] =1;
        
        // $payment_id= DB::table('tbl_payment')->insertGetId($data);
        
        //insert order
        $order_data=array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['billing_id'] = $request->address_bill;
        $order_data['order_note'] = $request->note_billing;
        $order_data['payment_id'] = $request->category_payment;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status_id'] = "1";
        $order_id= DB::table('tbl_order')->insertGetId($order_data);
        // insert order_detail
        $content = Cart::content();
        // echo "$content";
        foreach($content as $v_content){
        $detail_data['order_id'] = $order_id;
        $detail_data['product_id'] = $v_content->id;
        $detail_data['product_name'] = $v_content->name;
        $detail_data['product_price'] = $v_content->price;
        $detail_data['product_sales_quantity'] = $v_content->qty;
        $result= DB::table('tbl_detail')->insertGetId($detail_data);
        }
            
            $billing= DB::table('tbl_billing')->where('billing_id',$order_data['billing_id'] ) ->get();
            $order = DB::table('tbl_order')->where('order_id',$order_id)-> get();
            $note_order= DB::table('tbl_order')->where('order_id',$detail_data['order_id'] )->get();
            $customer= DB::table('tbl_customer')->where('customer_id',$order_data['customer_id'] )->get();
            $meta= DB::table('tbl_product')
            ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->get();
            foreach($meta as $key => $val) {
            $meta_desc = $val->categor_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title=$val->categor_name;
            $url_canonical = $request->url();
            }

            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
            $title_mail = "Đơn hàng xác nhận ngày".' '.$now;
            $customer_email = Customer::find(Session::get('customer_id'));
            $billing_email = Billing::find(Session::get('billing_id'));
           
            $data['email'][]= $customer_email->customer_email;
            // Gửi mail
            // lấy giỏ hàng
            
                foreach($content as $key => $cart_mail){
                    $cart_array[] = array(
                        'product_name'=> $cart_mail->name,
                        'product_price'=> $cart_mail->price,
                        'product_qty' => $cart_mail->qty,
                        'product_image'=> isset($cart_mail->option['image'])
                    );
                }
            
            // lấy billing
            $billing_array = array(
                'customer_name '=> $customer_email->customer_name,
                'billing_id'=>$billing[0]->billing_id,
                'billing_name'=>$billing[0]->billing_name,
                'billing_address'=>$billing[0]->billing_address,
                'billing_phone'=>$billing[0]->billing_phone,
                'total'=>isset($order_id['order_total'])
               
            );
            
            Mail::send('pages.mail_order',['cart_content'=>$cart_array,'billing'=>$billing_array],
            function($message) use ($title_mail, $data){
                $message -> to($data['email'])->subject($title_mail);
                $message -> from($data['email'],$title_mail);
            });

            DB::table('tbl_cart')->update(['status'=>1]);
            
            
            return view('pages.order')->with('info',$customer)->with('bill',$billing)->with('note_order',$note_order)
            ->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical);
        
    }
    //continue_shopping
    public function continue_shopping() {
        Cart::destroy();
        $continue_shopping_data=array();
        $continue_shopping_data['customer_id'] = Session::get('customer_id');
        $customer_continue= DB::table('tbl_customer')->where('customer_id',$continue_shopping_data['customer_id'] )->get();
        return Redirect::to('/home')->with('continue_shopping',$customer_continue);
    }

    
}
