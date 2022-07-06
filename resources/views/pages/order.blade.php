@extends('layout_home')
@section('contents')


<section class="breadcrumb breadcrumb_bg" style=" background-image: url({{ asset('public/frontend/images/breadcrumb5.jpg') }});">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Order Confirmation</h2>
              <p>Home <span>-</span> Order Confirmation</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- <div class="container">
    <h2>Striped Progress Bars</h2>
    <p>The .progress-bar-striped class adds stripes to the progress bars:</p> 
    <div class="progress">
      <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
        40% Complete (success)
      </div>
    </div>
    <div class="progress">
      <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
        50% Complete (info)
      </div>
    </div>
    <div class="progress">
      <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
        60% Complete (warning)
      </div>
    </div>
    <div class="progress">
      <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
        70% Complete (danger)
      </div>
    </div>
  </div> -->

  <section class="confirmation_part padding_top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="confirmation_tittle">
            <span style="font-size: 30px; color: #3f8899c7">Thank you. Your order has been received.</span>
          </div>
        </div>
        <div class="col-lg-12 " >
          @foreach($info as $key => $info)
          <div class="single_confirmation_details" style="background-color: #3f8899c7" >
            <h4  style="color: white">{{$info->customer_name}}</h4>
            <ul>
              <li>
                <p style="color: black">order number</p><span>: 60235</span>
              </li>
              <li>
                <p style="color: black">Date</p> <span>:</span>    <span id="current-time"></span>
                      <script>
                          var curDate = new Date();
                            
                          // Ngày hiện tại
                          var curDay = curDate.getDate();
                      
                          // Tháng hiện tại
                          var curMonth = curDate.getMonth() + 1;
                            
                          // Năm hiện tại
                          var curYear = curDate.getFullYear();
                      
                          // Gán vào thẻ HTML
                          document.getElementById('current-time').innerHTML = curDay + "/" + curMonth + "/" + curYear;
                      </script>
              </li>
              @endforeach 
              <li>
                <p style="color: black">Tax</p><span>: {{'$'.Cart::Tax(1)}}</span>
              </li>
              <li>
                <p style="color: black">Total</p><span>: {{'$'.Cart::total()}}</span>
              </li>
              <li>
                <p style="color: black">mayment methord</p><span>: Payment on delivery</span>
              </li>
            </ul>
          </div>
        
        </div>
        <div class="col-lg-12 " >
        
          <div class="single_confirmation_details" style="background-color: #3f8899c7" >
            <h4  style="color: white">Billing Address</h4>
            <ul>
            @foreach($bill as $key => $bill)
              <li>
                <p style="color: black">Address</p><span>: {{$bill->billing_address}}</span>
              </li>
              <li>
                <p style="color: black">Phone</p><span>: {{$bill->billing_phone}}</span>
              </li>
              
              @endforeach 
              @foreach($note_order as $key => $note_order)
              <li>
                <p style="color: black">Note</p><span>: {{$note_order->order_note}}</span>
              </li>
              @endforeach
              <li>
                <p style="color: black">Postcode</p><span>: 36952</span>
              </li>
            </ul>
          </div>
        
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12" >
          <div class="order_details_iner" style="background-color:#3f8899c7">
            <h3 style="color: black">Order Details</h3>
            <div class="cart_inner">
            <div class="table-responsive">
            <?php
             $content= Cart::content();
            
            ?>
          <table class="table">
            <thead>
              <tr>
                <th style="color: white" scope="col">Product</th>
                <th style="color: white" scope="col">Price</th>
                <th style="color: white" scope="col">Quantity</th>
                <th style="color: white" scope="col">Total</th>
                
              </tr>
            </thead>
            <tbody>
              <!-- Giỏ hàng thì ta dùng thư viện hỗ trọ shopping cart: nó giúp ta trong việc thêm-giảm
            số lượng sản phẩm, tính tổng số tiển, tính thuế, việc xóa sản phẩm sau khi thêm.
          Khi 1 sản phẩm được thêm vào giỏ hàng thì nó có sẵn rowId, price, weigth,... -->
                @foreach($content as $v_content)
                
                <tr>
                    <td>
                        <p style="color: black">{{$v_content->name}}</p>
                    </td>
                    <td>
                    <h5 style="color: black">${{number_format($v_content->price)}}</h5>
                    </td>
                    <td>
                        <a ><span style="color: black" class="middle">x {{$v_content->qty}}</span></a>
                    </td>
                    <td style="color: black">
                      <?php
                      $total=$v_content->price*$v_content->qty;
                      echo $total;
                      ?>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
          
          <div class="checkout_btn_inner float-right">
            <a style="background-color: black; color: white" class="btn_1" href="{{URL::to('/continue_shopping')}}">Continue Shopping</a>
            
          </div>
         
        </div>
      </div>
     
    </div>
  </div>
</div>
</div>
  
</section>

  @endsection