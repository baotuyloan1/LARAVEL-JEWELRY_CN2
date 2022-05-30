@extends('layout_home')
@section('contents')
<style>
  
  .box {
            display: flex;
            justify-content: space-between;
            width: 100%;
          }
  .box_2 {
    
    width: 80%;
    display: flex;
    justify-content: space-around;
    margin-left: 10%;
    align-items: center;
    
    }
  .rounded-lg:nth-child(1){
    background-color: silver;
  }
  .owl-nav{
      display: none;
  }
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

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
          <div class="carousel-item active">
            <a href="">
              <img src="{{ asset('public/frontend/images/anh_bia_2.jpg')}}" height="100%" width ="100%" alt="">
            </a>
          </div> 
        
          <div class="carousel-item ">
            <a href="">
              <img src="{{ asset('public/frontend/images/bia_jewel_2.jpg')}}" height="100%" width ="100%" alt="">
            </a>
          </div> <div class="carousel-item ">
            <a href="">
              <img src="{{ asset('public/frontend/images/anh_bia_1.jpg')}}" height="100%" width ="100%" alt="">
            </a>
          </div> 

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section><!-- End Hero -->
<br><br><br>

  <main id="main" style="width: 90%; margin-left: 5% ">

  <div class="box" >
          <div>
            <a href="">
              <img src="{{ asset('public/frontend/images/anh_jewel_1.jpg')}}" height="100%" width ="520px" alt="">
            </a>
          </div>
          <div>
            <a href="">
              <img src="{{ asset('public/frontend/images/anh_jewel_3.jpg')}}" height="100%" width ="520px" alt="">
            </a>
          </div>
          <div>
            <a href="">
              <img src="{{ asset('public/frontend/images/anh_jewel.jpg')}}" height="100%" width ="520px" alt="">
            </a>
          </div>
    </div>
<br><br>



<section>
  <div class="" >
       <h3 style="color: #5c2702">Category<span>shop</span></h3>
  </div>
  <div class="box_2" >
        @foreach($category as $key => $cate)
          <div style="border-radius: 50%; background-color:#eeeeee; width: 180px; height:180px;text-align: center">
            <a href="{{URL::to('/category_product/'.$cate->categor_id)}}">
              <img  src="{{URL::to('public/uploads/category/'.$cate->categor_image)}}" height="80%" width ="80%" alt="">
            </a>
            
            <p>{{$cate->categor_name}}</p>
          </div>
          @endforeach  
          
  </div>
</section>
  <br>
  <section>
  <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="">
                        <h3 style="color: #5c2702">Best Sellers <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class=" best_product_slider owl-carousel" >
                     @foreach($product2 as $key => $pro)
                        <div class="single_product_item" style="background: linear-gradient(to bottom,#fff 0%,#f7f7f7 100%);" >
                                                    
                            <div class="product_image" style="position: relative; height:300px; weight: 250px; text-align: center;">
                                <?php
                                                    
                                    if($pro->discount_percent >0) {
                                ?>
                                     <div class="discount_product" >-{{$pro->discount_percent}}%</div>
                                                        
                                     <?php
                                     }
                                ?>
                                       <br> <br>     
                                <a href="{{URL::to('/product_details/'.$pro->product_id)}}" >  
                                <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" alt="">
                                </a>
                                            
                            </div>
                            <div class="single_product_text"   >
                                <h4 style="color:#17a2b8" >{{$pro->product_name}}</h4>
                                <h3 style="color:#17a2b8" >
                                                <?php
                                                    
                                                    if($pro->discount_percent > 0) {
                                                ?>
                                                <span style="text-decoration: line-through;color: #4abdcfb0;">{{'$'.number_format($pro->product_price).'.'.'99'}}</span>
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

<section id="portfolio" class="portfolio">
      <div class="" >
          <h3 style="color: #5c2702">Product</h2>
      </div>
      <div class="container">
        <div class="row portfolio-container" data-aos="fade-up" >
          @foreach($product as $key => $pro)
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
<section>
  <div>
  <img src="{{ asset('public/frontend/images/anh_bia_kimnguu.jpg')}}" width="100%" height="20%" alt="">
  </div>
</section>


<section>
  <div class="row align-items-center" style="height: 20% ;width: 90%; margin-left: 5% ">
    <div class="" style="">
          <h3 style="color: #5c2702">New <span>Collection</span></h2>
    </div>
    <div class="col-lg-3 col-md-3" style="height: 100%; ">
    <img src="{{ asset('public/frontend/images/bosuutap.jpg')}}" height="100%" alt="">
    </div>
    <div class="col-lg-9 col-md-9" style=" height: 100%">
      <div class=" best_product_slider owl-carousel" >
        @foreach($set_product as $key => $set)
          <div class="single_product_item" style="background: linear-gradient(to bottom,#fff 0%,#f7f7f7 100%); " >
            <div class="product_image" style="position: relative; height:250px; weight: 250px; text-align: center;">
                <?php
                   if($set->discount_percent >0) {
                ?>
                <div class="discount_product_4" >-{{$set->discount_percent}}%</div>
                
                <?php
                  }
                ?>
                <br> <br> 
                <div class="discount_product_5" > <img src="{{ asset('public/frontend/images/new_product.svg')}}"  alt=""></div>
                                                            
                <a href="{{URL::to('/product_details/'.$set->product_id)}}" >  
                <img src="{{URL::to('public/uploads/product/'.$set->product_image)}}" alt="">
                </a>
                                            
            </div>
            <div class="single_product_text"   >
               <h4 style="color:#17a2b8l; height: 60px" >{{$set->product_name}}</h4>
                  <h3 style="color:#17a2b8" >
                    <?php
                      if($set->discount_percent > 0) {
                    ?>
                      <span style="text-decoration: line-through;color: #4abdcfb0;">{{'$'.number_format($set->product_price).'.'.'99'}}</span>
                    <?php
                      $price=(($set->product_price)*(100-($set->discount_percent)))/100;
                      echo "$", $price ;
                      }else{
                    ?>
                      {{'$'.number_format($set->product_price).'.'.'99'}}
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
</section>

<section>
  <div>
  <img src="{{ asset('public/frontend/images/bia_trang_suc_cuoi.jpg')}}" width="100%" height="20%" alt="">
  </div>
</section>

<section>
  <div class="row align-items-center" style="height: 20% ;width: 90%; margin-left: 5% ">
    <div class="" style="text-align: center;">
          <h3 style="color: #5c2702; text-align: center;"> Wedding Jewelry </h2>
    </div>
    <div style=" height: 100%">
      <div class=" best_product_slider owl-carousel" >
        @foreach($wedding_product as $key => $wedd)
          <div class="single_product_item" style="background: linear-gradient(to bottom,#fff 0%,#f7f7f7 100%);" >
            <div class="product_image" style="position: relative; height:300px; weight: 250px; text-align: center;">
                <?php
                   if($wedd->discount_percent >0) {
                ?>
                <div class="discount_product_4" >-{{$wedd->discount_percent}}%</div>
                <div class="discount_product_3" > <img src="{{URL::to('public/uploads/discount/'.$pro->discount_image)}}"  alt=""></div>
                
                <?php
                  } else {
                ?>
                <div class="discount_product_5" > <img src="{{ asset('public/frontend/images/new_product.svg')}}"  alt=""></div>
                <div class="discount_product_3" > <img src="{{URL::to('public/uploads/discount/'.$pro->discount_image)}}"  alt=""></div>
                <?php
                  }
                ?>
                
                <br> <br> 
                
                                                            
                <a href="{{URL::to('/product_details/'.$wedd->product_id)}}" >  
                <img src="{{URL::to('public/uploads/product/'.$wedd->product_image)}}" alt="">
                </a>
                                            
            </div>
            <div class="single_product_text"   >
               <h4 style="color:#17a2b8" >{{$wedd->product_name}}</h4>
                  <h3 style="color:#17a2b8" >
                    <?php
                      if($set->discount_percent > 0) {
                    ?>
                      <span style="text-decoration: line-through;color: #4abdcfb0;">{{'$'.number_format($wedd->product_price).'.'.'99'}}</span>
                    <?php
                      $price=(($wedd->product_price)*(100-($wedd->discount_percent)))/100;
                      echo "$", $price ;
                      }else{
                    ?>
                      {{'$'.number_format($wedd->product_price).'.'.'99'}}
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
</section>

<section>
  <div >
  <h2 style="text-align: center; color: #275e66"> THE ABC SYSTEM STRETCHES ACROSS THE COUNTRY</h2>
  <img src="{{asset('public/frontend/images/anh_cua_hang.jpg')}}"  width="100%" height="20%"  alt="">
  </div>
</section>

    <!-- <section id="services" class="services">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><a href="">Dolor Sitema</a></h4>
              <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bi bi-binoculars"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bi bi-brightness-high"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bi bi-calendar4-week"></i></div>
              <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
              <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
          </div>
        </div>

      </div>
    </section>End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    
    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Our <strong>Clients</strong></h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-1.png')}}" class="img-fluid" alt="">
            </div>
            
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-2.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-3.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-4.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-5.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-6.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-7.png')}}" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-xs-6">
            <div class="client-logo">
              <img src="{{ asset('public/frontend/images/clients/client-8.png')}}" class="img-fluid" alt="">
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Our Clients Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @endsection 

  