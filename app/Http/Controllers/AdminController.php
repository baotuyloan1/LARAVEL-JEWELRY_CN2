<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Carbon\Carbon;
use App\Models\Admin;
session_start();
class AdminController extends Controller
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

    public function index() {
        return view('admin.admin_login');
    }
    // Quên mật khẩu
    public function forget_password() {
        return view('admin.forget_password');
    }
    
    public function recover_password( Request $request) {
        $data = $request-> all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $title_mail = "Lấy lại mật khẩu furniture.com Admin".' '.$now;
        $admin =Admin::where('admin_email','=',$data['admin_email'])->get();
        foreach($admin as $key => $value) {
            $admin_id = $value->admin_id;
        }
        if($admin){
            $count_admin = $admin ->count();
            if($count_admin ==0) {
                return redirect()->back()->with('error','Email chưa được đăng ký để khôi phục mật khẩu!');
            }else {
                $token_random = Str::random();
                $admin = Admin::find($admin_id);
                $admin -> admin_token = $token_random;
                $admin-> save();

                $to_email = $data['admin_email'];
                $link_reset_pass = url('/update_new_password?email='.$to_email.'&token='.$token_random);

                $data= array('name'=>$title_mail,'body'=>$link_reset_pass,'email'=>$data['admin_email']);

                Mail::send('admin.forget_mail',['data'=>$data],function($message) use ($title_mail, $data)
            {
                $message -> to($data['email'])->subject($title_mail);
                $message -> from($data['email'],$title_mail);
            });
            return redirect()->back()->with('message','Gửi mail thành công, vui lòng vào email để reset password!');
            }
        }
    }
    public function update_new_password() {
        return view('admin.new_password');
    }
    public function reset_new_password(Request $request) {
        $data = $request-> all();
        $token_random = Str::random();
        $admin_pass = Admin::where('admin_email','=',$data['email'])->where('admin_token','=',$data['token'])->get();
        $count = $admin_pass ->count();
        if($count>0) {
            foreach($admin_pass as $key => $admin) {
                $admin_id = $admin ->admin_id;
            }
           $reset = Admin::find($admin_id);
           $reset->admin_password = md5($data['admin_pass']);
           $reset->admin_token = $token_random;
           $reset->save();
           return redirect('admin')->with('message','Mật khẩu vừa được cập nhật mới. Vui lòng đăng nhập để tiếp t');
        }else{
            return redirect('forget-password')->with('error','Vui lòng nhập lại email vì ink đã quá hạn');
        }
    }

    public function show_dashboard() {
        $this->Authadmin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request) {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $remember = $request->has('remember') ? true : false;
        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password',$admin_password)->first();
        // Kiểm tra có đúng email hay mật khẩu không
        if($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else {
            Session::put('message','Mật khẩu hoặc email không đứng. Vui lòng nhập lại!');
            return Redirect::to('/admin');
        
        }
    }

    public function logout() {
        $this->Authadmin();
            Session::put('admin_name', null);
            Session::put('admin_id',null);
            return Redirect::to('/admin');
    }
    // manage_order
    public function manage_order() {
        $this->Authadmin();
        // join là tham gia của các bảng khác
        $all_order= DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_order_status','tbl_order_status.order_status_id','=','tbl_order.order_status_id')
        ->select('tbl_order.*','tbl_order_status.*','tbl_customer.customer_name') 
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin.admin_layout')->with('admin.manager_order',$manager_order);
    }

    public function view_order($orderId) {
        $this->Authadmin();
        // join là tham gia của các bảng khác
        $order_by_id= DB::table('tbl_order')->where('tbl_order.order_id',$orderId)
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_billing','tbl_billing.billing_id','=','tbl_order.billing_id')
        ->join('tbl_detail','tbl_order.order_id','=','tbl_detail.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_billing.*','tbl_detail.*')->first();
        $detail_order=DB::table('tbl_detail')->where('order_id',$orderId)->orderby('detail_id','desc')->get();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id)->with('detail_order',$detail_order);
        return view('admin.admin_layout')->with('admin.view_order',$manager_order_by_id);
    }
    public function edit_order($orderId) {
        $this->Authadmin();
        // join là tham gia của các bảng khác
        $order_edit= DB::table('tbl_order')->where('tbl_order.order_id',$orderId)
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_billing','tbl_billing.billing_id','=','tbl_order.billing_id')
        ->join('tbl_order_status','tbl_order.order_status_id','=','tbl_order_status.order_status_id')
        ->select('tbl_order.*','tbl_customer.customer_name','tbl_billing.*','tbl_order_status.*')->get();
        
        $cate_order= DB::table('tbl_order_status')->orderby('order_status_id','desc')->get();
        $manager_order_edit = view('admin.edit_order')->with('order_edit',$order_edit)->with('cate_order',$cate_order);
        return view('admin.admin_layout')->with('admin.edit_order',$manager_order_edit);
    }
    public function delete_order($orderId) {
        $this->Authadmin();
        DB::table('tbl_order')->where('order_id',$orderId)->update(['order_status_id'=>3]);
        Session::put('mess1','Bạn vừa xóa 1 đơn hàng thành công');
        return Redirect::to('/manage_order');
    }
    public function update_order(Request $request,$orderId) {
        $this->Authadmin();
        $data_order_update = array();
        $data_order_update['order_status_id'] = $request ->category_order;
        $data_order_update['order_note'] = $request ->order_note;
        DB::table('tbl_order')->where('order_id',$orderId)->update($data_order_update);
        Session::put('mess','Đã sửa đơn hàng thành công');
        return Redirect::to('/manage_order');
    }

    public function search_order( Request $request) {
        $keysearch = $request-> keysearch;
        
        $search_order= DB::table('tbl_order')
        ->join('tbl_customer','tbl_customer.customer_id','=','tbl_order.customer_id')
        ->join('tbl_order_status','tbl_order_status.order_status_id','=','tbl_order.order_status_id')
        ->select('tbl_order.*','tbl_order_status.*','tbl_customer.customer_name') 
        ->where('tbl_customer.customer_name','like','%'.$keysearch.'%')->get();
        $search = view('admin.search_order')->with('search_order',$search_order);
        return view('admin.admin_layout')->with('admin.search_order',$search);
     }

    // manage_customer
    public function manage_customer() {
        $this->Authadmin();
        // join là tham gia của các bảng khác
        $all_customer= DB::table('tbl_customer')
        ->join('tbl_billing','tbl_billing.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_customer.*','tbl_billing.*') 
        ->orderby('tbl_customer.customer_id','desc')->get();
        $manager_customer = view('admin.manage_customer')->with('all_customer',$all_customer);
        return view('admin.admin_layout')->with('admin.manager_customer',$manager_customer);
    }
    public function delete_customer($customerId) {
        $this->Authadmin();
        DB::table('tbl_customer')->where('customer_id',$customerId)->delete();
        Session::put('mess1','Bạn vừa xóa 1 khách hàng thành công');
        return Redirect::to('/manage_customer');
    }
}
