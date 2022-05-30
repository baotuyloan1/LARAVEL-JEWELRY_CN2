<style>
  .product_image{
    position: relative;
}
.discount_product{
      position: absolute; 
      width: 40px; 
      height:40px;
      bottom:80%;
      left:80%; 
      border-radius: 16px;
      color: white; 
      font-weight:900 ;
      background-color: #17a2b8;
      display: flex;
      align-items: center;
      justify-content: center;
  }
</style>

@extends('layout_home')
@section('contents')

<section class="breadcrumb breadcrumb_bg" style=" background-image: url({{ asset('public/frontend/images/anh_cua_hang.jpg') }}); height: 50%">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item" style="color: white">
              <h2 style="color: white; font: 50px">Cart Products</h2>
              <p style="color: white">Home <span>-</span style="color: white">Cart Products</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cart_area padding_top">
    <div class="container" style="background-color: #114b58">
      <div class="cart_inner">
        <div class="table-responsive" >
            <?php
             $content= Cart::content();
            ?>
            @if (session('alert'))
              <div class="alert alert-danger" role="alert">
                      {{ session('alert') }}
              </div>
          @endif
          <table class="table">
            <thead>
              <tr>
                <th style="color: white" scope="col">Product</th>
                <th style="color: white" scope="col">Price</th>
                <th style="color: white" scope="col">Quantity</th>
                <th style="color: white"scope="col">Total</th>
                <th style="color: white"scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Giỏ hàng thì ta dùng thư viện hỗ trọ shopping cart: nó giúp ta trong việc thêm-giảm
            số lượng sản phẩm, tính tổng số tiển, tính thuế, việc xóa sản phẩm sau khi thêm.
          Khi 1 sản phẩm được thêm vào giỏ hàng thì nó có sẵn rowId, price, weigth,... -->
                @foreach($content as $v_content)
                
                <tr>
                    <td>
                    <div class="media">
                        <div class="d-flex">
                        
                        <img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" height="100px" width ="100px" alt="">
                        </div>
                        <div class="media-body">
                        <p style="color: white">{{$v_content->name}}</p>
                        </div>
                    </div>
                    </td>
                    <td>
                    <h5 style="color: white">{{'$'.($v_content->price)}}</h5>
                    </td>
                    <td>
                    
                    <form action="{{URL::to('/update_product')}}"method="POST">
                      {{csrf_field()}}
                        <input class="input-number" style=" height: 32px; width: 120px" type="text" name="cart_quantity" value="{{$v_content->qty}}">
                        <input type="hidden" style="color: white" value="{{$v_content->rowId}}" name="rowId_cart">
                        <input type="submit" value="update" name="update_product" class="btn btn-dark btn-sm" >
                    
                    </form>
                    </td>
                    <td style="color: white">
                      <?php
                      $total=$v_content->price*$v_content->qty;
                      echo $total;
                      ?>
                    
                    </td>
                    <td >
                    <a onclick  = "return confirm('Are you sure to delete this product?')" class="btn btn-dark" href="{{URL::to('/detele-to-cart/'.$v_content->rowId)}}"><i class="bi bi-x-square-fill"></i></a>
                    </td>
                </tr>
                @endforeach
              
              <tr>
                <td></td>
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
                <td></td>
                <td>
                  <h5 style="color: white">Total</h5>
                </td>
                <td>
                  <h5 style="color: white">{{'$'.Cart::total()}}</h5>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right" style="margin-left: 50%">
            <a style="background-color: black; color: white" class="btn_1"  href="{{URL::to('/home')}}">Continue Shopping</a>

                            <?php
                                $customer_id= Session::get('customer_id');
                                if($customer_id!=NULL) {

                            ?> 
   
                            <a style="background-color: black; color: white" class="btn_1 checkout_btn_1" href="{{URL::to('/checkout')}}">Proceed to checkout</a>
                            
                            <?php
                            }else {
                            ?>
                            <a  style="background-color: black; color: white"class="btn_1 checkout_btn_1" href="{{URL::to('/login_customer')}}">Proceed to checkout</a>    
                            <?php
                            }
                            ?>
            
          </div>
        </div>
        <div style="height: 10px"></div>
      </div>
  </div>
</section>

<!-- product_list part start-->
<section class="product_list best_seller section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Best Sellers <span>shop</span></h2>
                    </div>
                </div>
            </div> 
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class=" best_product_slider owl-carousel" >
                    @foreach($best_seler as $key => $seller)
                        <div class="single_product_item" style="background: linear-gradient(to bottom,#fff 0%,#f7f7f7 100%);" >
                                                    
                            <div class="product_image" style="position: relative; height:300px; weight: 250px; text-align: center;">
                                <?php
                                                    
                                    if($seller->discount_percent >0) {
                                ?>
                                     <div class="discount_product" >-{{$seller->discount_percent}}%</div>
                                                        
                                     <?php
                                     }
                                ?>
                                       <br> <br>     
                                <a href="{{URL::to('/product_details/'.$seller->product_id)}}" >  
                                <img src="{{URL::to('public/uploads/product/'.$seller->product_image)}}" alt="">
                                </a>
                                            
                            </div>
                            <div class="single_product_text"   >
                                <h4 style="color:#17a2b8" >{{$seller->product_name}}</h4>
                                <h3 style="color:#17a2b8" >
                                                <?php
                                                    
                                                    if($seller->discount_percent > 0) {
                                                ?>
                                                <span style="text-decoration: line-through;color: #4abdcfb0;">{{'$'.number_format($seller->product_price).'.'.'99'}}</span>
                                                <?php
                                                        $price=(($seller->product_price)*(100-($seller->discount_percent)))/100;
                                                            echo "$", $price ;
                                                    
                                                    }else{
                                                ?>
                                                {{'$'.number_format($seller->product_price).'.'.'99'}}
                                                <?php
                                                    }
                                                    ?>
                                </h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part end-->


@endsection