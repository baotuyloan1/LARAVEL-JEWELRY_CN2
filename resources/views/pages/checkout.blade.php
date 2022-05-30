@extends('layout_home')
@section('contents')
<style>
  #bill {
  color: white;
  overflow: hidden;
  display: none;
  width: 700px;
  height: auto;
  position: fixed;
  left: 25%;
  top: 20%;
  background-color: white ;
  border-color:solid 2px  #57bad1;
  z-index: 1;
}
.exit_buy{
  position: absolute; 
    width: 50px; 
    height:40px;
    top:1%;
    left:92%;
    color: white; 
    background-color: black;
    display: flex;
    align-items: center;
    justify-content: center;
 }
 
.add_bill {
  position: relative;
}
</style>

    <section class="breadcrumb breadcrumb_bg" style=" background-image: url({{ asset('public/frontend/images/anh_cua_hang.jpg') }}); height: 50%">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2 style="color: white; font: 80px">Product Checkout</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
            <div id="bill" >
              <br><br>
                  <h3 style="color:#57bad1; text-align: center">Billing Details </h3>
                  <div class="exit_buy">
                      <button class="btn btn-dark" onclick="myFunction_exitbill()"> <i class="bi bi-x-lg"></i></button>
                    </div>
                  <form class="row contact_form" action="{{URL::to('/billing_checkout')}}" method="POST"   novalidate="novalidate">
                  {{csrf_field()}}
                    
                    <div class="col-md-12 form-group ">
                    <h6 style="color:#57bad1; margin-left:20px">Name</h6>
                      <input style="width:650px;margin-left:20px" type="text" class="form-control"  name="name_billing">
                      <span class="placeholder" ></span>
                    </div>
                    <div class="col-md-12 form-group ">
                      <h6 style="color:#57bad1;margin-left:20px">Phone Number</h6> 
                      <input style="width:650px;margin-left:20px" type="text" class="form-control" name="phone_billing">
                      <span class="placeholder" data-placeholder="Phone number"></span>
                    </div>
                    <div class="col-md-12 form-group ">
                      <h6 style="color:#57bad1;margin-left:20px">Email</h6>
                      <input style="width:650px;margin-left:20px" type="text" class="form-control" name="email_billing">
                      <span class="placeholder" data-placeholder="Email Address"></span>
                    </div>
                    
                    <div class="col-md-12 form-group ">
                    <h6 style="color:#57bad1;margin-left:20px">Address</h6>
                      <input style="width:650px;margin-left:20px" type="text" class="form-control"  name="address_billing">
                      <span class="placeholder" data-placeholder="Address line "></span>
                    </div>
                    <div class="col-md-12 form-group">
                      <div class="creat_account">
                      <input style="margin-left:38%"  type="submit" class="btn btn-dark" style="color:white " name="create_account" value="Create an account">
                      </div>
                    </div>
                  </form>
            </div>
    <section  class="checkout_area padding_top">
      <div class="row" style="background-color: #57bad1" >
        <h5 class="col-lg-6" style="color:white;padding-left:50px; padding-top: 10px">ADDRESS BILLING</h5>  
        <div class="col-lg-6">
          <button onclick="myFunction()" style="margin-left:83%" class="btn btn-dark">+Address</button>
        </div>
     </div> 
    <form action="{{URL::to('/order_place')}}" method="POST">
      {{csrf_field()}}
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-12">
            <div id="add_bill" class="returning_customer">
              <div class="check_title" style="color:#ff3368; font-style: normal; border:#57bad1 3px solid;text-align: left">
                    <br>
                      <div style="margin-left:5px">
                        <?php
                        $customer_id = Session::get('customer_id');
                        
                        if($bill_id=DB::table('tbl_billing')->where('tbl_billing.customer_id','=',$customer_id)->exists()) {
                        
                        ?>
                        <br>
                          <div >
                            @foreach($address_billing as $key =>$bill)  
                            <div class="form-check" style="text-align:left; color:#57bad1; ">
                              <input class="form-check-input" type="radio" name="address_bill"  value="{{$bill->billing_id}}" checked  >
                              <label class="form-check-label" for="{{$bill->billing_id}}">
                              <label for="" style="width: 1200px">{{$bill->billing_name}} - {{$bill->billing_phone}} </label>  <a onclick  = "return confirm('Are you sure to delete this address?')" class="btn btn-dark" href="{{URL::to('/detele-to-billing/'.$bill->billing_id)}}"><i class="bi bi-x-square-fill"></i></a>
                              <br>
                              {{$bill->billing_address}}
                              </label>
                              <hr style = "width:90%; ">
                            </div>
                            
                            @endforeach
                          </div> 
                        
                        <?php
                        }else {
                        ?>
                        <br>
                        <h6 style="color:#ff3368">Please add a shipping address to continue </h6> 
                        <hr style = "width:90%; ">
                        <?php
                        }
                        ?>
                      </div>
                      <!-- <div>
                      </div> -->
                      <br>
              </div>
              <br>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="order_box" style="background-color: #3f8899c7">

              <div class="cart_inner">
                <div class="table-responsive">
                  <?php
                  $content= Cart::content();
                  
                  ?>
                  <table class="table" >
                    <thead>
                      <tr style="color: white">
                        <th style="color: white" scope="col">Product</th>
                        
                        <th style="color: white" scope="col">Quantity</th>
                        <th style="color: white" scope="col">Total</th>
                        
                      </tr>
                    </thead>
                    <tbody >
                      <!-- Giỏ hàng thì ta dùng thư viện hỗ trọ shopping cart: nó giúp ta trong việc thêm-giảm
                    số lượng sản phẩm, tính tổng số tiển, tính thuế, việc xóa sản phẩm sau khi thêm.
                    Khi 1 sản phẩm được thêm vào giỏ hàng thì nó có sẵn rowId, price, weigth,... -->
                        @foreach($content as $v_content)
                        
                        <tr>
                            <td>
                                <p style="color: white">{{$v_content->name}}</p>
                                
                            </td>
                            
                            <td>
                                <a  style="color: white"><span class="middle">x {{$v_content->qty}}</span></a>
                            
                            </td>
                            <td style="color: white">
                              <?php
                              $total=$v_content->price*$v_content->qty;
                              echo $total;
                              ?>
                            
                            </td>
                            
                        </tr>
                        @endforeach
                      
                      <tr>
                        
                        <td></td>
                        <td>
                          <h5 style="color: white">Subtotal</h5>
                        </td>
                        <td>
                          <h5 style="color: white">{{'$'.Cart::subtotal()}}</h5>
                        </td>
                      </tr>
                    
                      <tr class="shipping_area">
                        
                        <td></td>
                        <td>
                          <h5 style="color: white">Shipping</h5>
                        </td>
                        <td>
                            <h5 style="color: white">Free</h5>
                        </td>    
                      </tr>
                      <tr>
                      
                        <td></td>
                        <td>
                          <h5 style="color: white">Eco Tax</h5>
                        </td>
                        <td>
                        <!-- Xét thuế theo phần trăm tổng tiền sản phẩm -->
                          <h5 style="color: white">{{'$'.Cart::Tax(1)}}</h5>  
                        </td>
                      </tr>
                      <tr>
                        
                        <td></td>
                        <td>
                          <h5 style="color: white">Total</h5>
                        </td>
                        <td>
                          <h5 name="cart_total" style="color: white">{{'$'.Cart::total()}}</h5>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
          
                </div>
              </div> 
              <div class="col-md-12 form-group p_star">
                <h5 style="color:white">Payment methods</h5>
                <select name='category_payment'>
                  @foreach($cate_payment as $key => $cate)
                  <option value ='{{$cate->payment_id}}'>{{$cate->payment_method}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 form-group">
                <h5 style="color:white">Shipping Notes</h5>
                <textarea class="form-control" name="note_billing"  rows="1" placeholder="Order Notes"></textarea>
              </div>
              <div class="creat_account">
                <input type="checkbox" id="f-option4"  name="selector">
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms &amp; conditions*</a>
              </div>
              <?php
                $billing_id = Session::get('billing_id');
                if($billing_id != NULL){
                  ?>
                  <input type="submit" style="margin-left:80%;background-color: black; border: 2px solid #6e5f4b"  class="btn_3" name="send_order_confirmation" value="Proceed to Paypal">
                <?php
                
                }else {
                ?>
                  <a style=" margin-left:80%;background-color: black; color: white" class="btn_1 checkout_btn_1" href="{{URL::to('/checkout')}}">Proceed to Paypal</a>
                <?php
                }
              ?>
              
            </div>
          </div>
        
      </div>
    </form>
  </section>
  

@endsection

<script>
          function myFunction() {
            
            document.getElementById("bill").style.display = "block";
            document.getElementById("body").style.background = "#9797a3a6";
            document.getElementsByClassName("checkout_area ").style.color = "red";
          };
          function myFunction_exitbill() {
            document.getElementById("bill").style.display = "none";
            document.getElementById("body").style.background = "white";
          };
  
</script>
