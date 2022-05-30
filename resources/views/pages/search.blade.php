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
  
  .discount_product_5{
      position: absolute; 
      width: 13%; 
      height: 13%;
      bottom:80%;
      left:80%; 
      border-radius: 16px;
      color: white; 
      font-weight:900 ;
      display: flex;
      align-items: center;
      justify-content: center;
  }
  .discount_product_4{
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
  .discount_product_2{
    position:absolute ; 
    width: 40px; 
    height:40px;
    bottom:80%;
    left:80%; 
    color: #17a2b8; 
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .discount_product_3{
    position:absolute ; 
    width: 27%; 
    height:27%;
    bottom:5%;
    left:5%; 
    color: #17a2b8; 
    display: flex;
    align-items: center;
    justify-content: center;
  }
</style>


@extends('layout_home')
@section('contents')


<!-- product_list start-->
<section id="portfolio" class="portfolio">
      <div class="" style="margin-left: 15%;">
      <h3 style="color: #5c2702">Search<span>Result</span></h2>
      </div>
      <div class="container">
        <div class="row portfolio-container" data-aos="fade-up" >
          @foreach($search_product as $key => $pro)
          <div class="col-lg-4 col-md-6 portfolio-item"  >
            <form >
               @csrf
                <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
                <input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
                <input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
                <input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
                <input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                
                  <?php
                     if($pro->discount_percent >0) {
                  ?>
                  <div class="discount_product_2" > <span style="font-size: 25px; font-weight:900;"> -{{$pro->discount_percent}}</span>  %</div>
                  <div class="discount_product_3" > <img src="{{URL::to('public/uploads/discount/'.$pro->discount_image)}}"  alt=""></div>
                  <?php
                  }else{
                  ?>
                
                  <div class="discount_product_5" > <img src="{{ asset('public/frontend/images/new_product.svg')}}"  alt=""></div>
                  <?php
                  }
                  ?>



            <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" style="background: linear-gradient(to bottom,#fff 0%,#f7f7f7 100%);" class="img-fluid" alt="">
            <div class="portfolio-info" style="background-color:#4abdcfb0" >
              <h4>{{$pro->product_name}}</h4>
              <p>{{$pro->categor_name}}</p>
              <a href="{{URL::to('public/uploads/product/'.$pro->product_image)}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="{{$pro->product_name}}"><i class="bx bx-plus"></i></a>
              <a href="{{URL::to('/product_details/'.$pro->product_id)}}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        @endforeach
        </div>

      </div>
</section><!-- End Portfolio Section -->


<!-- banner part start-->
<section class="banner_part" style="background-color: #6e5f4b">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_slider owl-carousel">
                        <div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>Wood & Cloth
                                                Sofa</h1>
                                            <p>Incididunt ut labore et dolore magna aliqua quis ipsum
                                                suspendisse ultrices gravida. Risus commodo viverra</p>
                                            <a href="#" class="btn_2">buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="{{ asset('public/frontend/images/banner_img.png') }}" alt="">
                                </div>
                            </div>
                        </div><div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>Cloth & Wood
                                                Sofa</h1>
                                            <p>Incididunt ut labore et dolore magna aliqua quis ipsum
                                                suspendisse ultrices gravida. Risus commodo viverra</p>
                                            <a href="#" class="btn_2">buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="{{ asset('public/frontend/images/banner_img.png') }}" alt="">
                                </div>
                            </div>
                        </div><div class="single_banner_slider">
                            <div class="row">
                                <div class="col-lg-5 col-md-8">
                                    <div class="banner_text">
                                        <div class="banner_text_iner">
                                            <h1>Wood & Cloth
                                                Sofa</h1>
                                            <p>Incididunt ut labore et dolore magna aliqua quis ipsum
                                                suspendisse ultrices gravida. Risus commodo viverra</p>
                                            <a href="#" class="btn_2">buy now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="banner_img d-none d-lg-block">
                                    <img src="{{ asset('public/frontend/images/banner_img.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="slider-counter"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->


<!-- feature_part start-->
<section class="feature_part padding_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section_tittle text-center">
                    <h2>Featured Category</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-between">
        @foreach($category as $key => $cate)
            <div class="col-sm-6">
                <div class="single_feature_post_text" style="background-color:#241a0191;border: 3px solid #0e1818;">
                    <p>Premium Quality</p>
                    <h3>{{$cate->categor_name}}</h3>
                    <img src="{{URL::to('public/uploads/category/'.$cate->categor_image)}}"height="300" width ="300" alt="">
                    <a href="{{URL::to('/danh-muc-san-pham/'.$cate->categor_id)}}" class="feature_btn">EXPLORE NOW <i class="fas fa-play"></i></a>  
                    
                </div>
               
            </div>
            @endforeach  
        </div>
       
    </div>
</section>
<!-- upcoming_event part start-->
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
                <div class="col-lg-12" >
                    <div class="best_product_slider owl-carousel">
                    @foreach($search_product as $key => $pro)
                    <div class="single_product_item" style=" background-color:#4e390391 ">
                        <div class="product_image" style="position: relative;">
                                            <?php
                                                                
                                            if($pro->discount_percent >0) {
                                            ?>
                                            <div class="discount_product" >-{{$pro->discount_percent}}%</div>
                                            <?php
                                            }
                                            ?>
                                                        
                                            <a href="{{URL::to('/product_details/'.$pro->product_id)}}" >  
                                            <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="200" width ="200" alt="">
                                            </a>
                                                        
                        </div> 
                        <div class="single_product_text">
                            <h4 >{{$pro->product_name}}</h4>
                            <h3 >
                                                <?php
                                                    
                                                    if($pro->discount_percent >0) {
                                                ?>
                                                <span style="text-decoration: line-through;color: #c8c8d3;">{{'$'.number_format($pro->product_price).'.'.'99'}}</span>
                                                <?php
                                                        $price=(($pro->product_price)*(100-($pro->discount_percent)))/100;
                                                            echo "$", $price ;
                                                    }else{
                                                ?>
                                                {{'$'.number_format($pro->product_price).'.'.'99'}}
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

    <!-- linear-gradient(0, rgba(41, 196, 88, 0.904), #666); -->
    <section class="subscribe_area section_padding" style=" background-image: url({{ asset('public/frontend/images/subscribe_area.png') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="subscribe_area_text text-center">
                        <h5>Join Our Newsletter</h5>
                        <h2>Subscribe to get Updated
                            with new offers</h2>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="enter email address" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <a href="#" class="input-group-text btn_2" id="basic-addon2">subscribe now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- subscribe_area part start-->
    <section class="client_logo padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_1.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_2.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_3.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_4.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_5.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_3.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_1.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_2.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_3.png') }}" alt="">
                    </div>
                    <div class="single_client_logo">
                        <img src="{{ asset('public/frontend/images/client_logo/client_logo_4.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::subscribe_area part end::-->




@endsection