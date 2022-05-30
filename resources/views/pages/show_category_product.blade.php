<style>
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

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>CATEGORY</h2>
          <ol>
            <li><a href="{{URL::to('/home')}}">Home</a></li>
            <li>Category</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
            @foreach($category_name as $key => $cate_name) 
              <li data-filter=".{{$cate_name->meta_keywords}}" class="filter-active">{{$cate_name->categor_name}}</li>
           
            @endforeach
            @foreach($category_all as $key => $cate_all)
            
              <li data-filter=".{{$cate_all->meta_keywords}}">{{$cate_all->categor_name}} </li>
            
            @endforeach
            
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
          @foreach($show_category_product as $key => $pro)
          <div class="col-lg-4 col-md-6 portfolio-item {{$pro->meta_keywords}} "  >
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
    </section>
    
    <!-- End Portfolio Section -->

  </main><!-- End #main -->

@endsection 