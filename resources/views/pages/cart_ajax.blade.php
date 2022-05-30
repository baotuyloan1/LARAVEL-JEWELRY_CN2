
@extends('layout_home')
@section('contents')

<section class="breadcrumb breadcrumb_bg" style=" background-image: url({{ asset('public/frontend/images/breadcrumb.png') }});">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Cart Products</h2>
              <p>Home <span>-</span>Cart Products</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
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
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Giỏ hàng thì ta dùng thư viện hỗ trọ shopping cart: nó giúp ta trong việc thêm-giảm
            số lượng sản phẩm, tính tổng số tiển, tính thuế, việc xóa sản phẩm sau khi thêm.
          Khi 1 sản phẩm được thêm vào giỏ hàng thì nó có sẵn rowId, price, weigth,... -->
                <?php
                print_r(Session::get('cart'));
                ?>
                
                <tr>
                    <td>
                    <div class="media">
                        <div class="d-flex">
                        
                        <img src="" height="100" width ="100" alt="">
                        </div>
                        <div class="media-body">
                        <p></p>
                        </div>
                    </div>
                    </td>
                    <td>
                    <h5></h5>
                    </td>
                    <td>
                    <form action="{{URL::to('/update_product')}}"method="POST">
                      {{csrf_field()}}
                        <input class="input-number" type="text" name="cart_quantity" value="">
                        <input type="hidden" value="" name="rowId_cart">
                        <input type="submit" value="cập nhật" name="update_product" class="btn btn-info" >
                    
                    </form>
                    </td>
                    <td>
                      <?php
                      // $total=$v_content->price*$v_content->qty;
                      // echo $total;
                      ?>
                    
                    </td>
                    <td >
                    <a class="btn btn-danger" href=""><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                
              <tr class="bottom_button">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Subtotal</h5>
                </td>
                <td>
                  <h5>{{'$'.Cart::subtotal()}}</h5>
                </td>
              </tr>
             
              <tr class="shipping_area">
                <td></td>
                <td></td>
                <td>
                  <h5>Shipping</h5>
                </td>
                <td>
                    <h5>Free</h5>
                </td>    
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Eco Tax</h5>
                </td>
                <td>
                <!-- Xét thuế theo phần trăm tổng tiền sản phẩm -->
                  <h5>{{'$'.Cart::Tax(1)}}</h5>  
                </td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>
                  <h5>Total</h5>
                </td>
                <td>
                  <h5>{{'$'.Cart::total()}}</h5>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="#">Continue Shopping</a>

                            <?php
                                $customer_id= Session::get('customer_id');
                                if($customer_id!=NULL) {

                            ?> 
   
                            <a  class="btn_1 checkout_btn_1" href="{{URL::to('/checkout')}}">Proceed to checkout</a>
                            
                            <?php
                            }else {
                            ?>
                            <a class="btn_1 checkout_btn_1" href="{{URL::to('/login_customer')}}">Proceed to checkout</a>    
                            <?php
                            }
                            ?>
            
          </div>
        </div>
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
                    <div class="best_product_slider owl-carousel">
                    @foreach($best_seler as $key => $seller)
                    <a href="{{URL::to('/product_details/'.$seller->product_id)}}">
                        <div class="single_product_item">
                            <img src="{{URL::to('public/uploads/product/'.$seller->product_image)}}" height="200" width ="200" alt="">
                            <br>
                            <h4 style="text-align: center">{{$seller->product_name}}</h4>
                            <div class="single_product_text">
                                
                                <h3>{{'$'.number_format($seller->product_price).''.'99'}}</h3>
                            </div>
                        </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product_list part end-->


@endsection