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
.product_description_area .nav.nav-tabs li a.active {
    background: #fffdfc;
    color: #121211;
    border-color: #221916;
    box-shadow: -1.717px 8.835px 29.76px 2.24px rgb(255 51 104 / 18%);
}
.background_love {
    border-radius: 50%;
    background-color: white;
    box-shadow: 0px 10px 20px 0px rgb(153 153 153 / 30%);
    width: 50px;
    height: 50px;
    line-height: 56px;
    color: #7f7f7f;
    display: flex;
      align-items: center;
      justify-content: center;

}
 /*Hiệu ứng zoom*/
 .zoom:hover {
  transform: scale(1.5,1.5);
-webkit-transform: scale(1.5,1.5);
-moz-transform: scale(1.5,1.5);
-o-transform: scale(1.5,1.5);
-ms-transform: scale(1.5,1.5);
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
 

</style>
                    <?php // để dòng message thông báo 
                                $message =Session::get('rating');
                    ?>

<!-- <section class="breadcrumb breadcrumb_bg" style=" background-color: #6e5f4b; background-image: url({{ asset('public/frontend/images/breadcrumb5.jpg') }});">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Shop Single</h2>
              <p>Home <span>-</span> Shop Single</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

<!--================Single Product Area =================-->

<div id="bill" class ="container" >
  @foreach($details_product as $key => $det_pro)
      <div class="exit_buy">
        <button class="btn btn-dark" onclick="myFunction_exitbuy()"> <i class="bi bi-x-lg"></i></button>
      </div>
      <div class="row s_product_inner justify-content-between">
        <div class="col-lg-7 col-xl-7">
          <div class="product_slider_img">
            <br><br>
          <img class="zoom" src="{{ asset('public/uploads/product/'.$det_pro->product_image) }}">
          </div>
        </div>
        
        <div class="col-lg-5 col-xl-5">
          <div class="s_product_text">
            <br>
            <h3 style="color: #6e5f4b">{{$det_pro->product_name}}</h3>
            <h2 style="color: black"><?php
                                                    
                   if($det_pro->discount_percent > 0) {
                  ?>
                    <span style="text-decoration: line-through;color: #c8c8d3;">{{'$'.number_format($det_pro->product_price).'.'.'99'}}</span>
                    
                    <?php
                     $price=(($det_pro->product_price)*(100-($det_pro->discount_percent)))/100;
                        echo "$", $price;
                      
                    }else{
                    ?>
                    {{'$'.number_format($det_pro->product_price).'.'.'99'}}
                    <?php
                    }
                    ?>
                    </h2>
            <ul class="list">
              <li>
                <a class="active" href="#" style="color: black">
                  <span>Category</span>: {{$det_pro->categor_name}}</a>
              </li>
              <li>
                <a href="#"> <span>Availibility</span> : In Stock</a>
              </li>
            </ul>
            <p>
              First replenish living. Creepeth image image. Creeping can't, won't called.
              Two fruitful let days signs sea together all land fly subdue
            </p>


            <form action="{{URL::to('/checkout_buy')}}"method ="POST">
                {{csrf_field()}}

              <div class="card_area d-flex justify-content-between align-items-center">
                <div class="product_count" style="color: black">
                  <span class="inumber-decrement"> <i class="bi bi-dash"></i></span>
                  <input name="quantity" class="input-number" type="text" value="1" min="0" max="10">
                  
                  <span class="number-increment"> <i class="bi bi-plus"></i></span>
                  <input name="productid_hidden" type ="hidden" value="{{$det_pro ->product_id}}" />
                </div>
                              <?php
                                $customer_id= Session::get('customer_id');
                                if($customer_id==NULL) {

                             ?>
                             <a style="background-color: #57bad1;border: 2px solid #508fad" class="btn_3" href="{{URL::to('/login_customer')}}">buy</a>     
                            <?php
                            }else {
                            ?>
                            <input style="background-color: #57bad1;border: 2px solid #508fad" type="submit" class="btn_3" value="buy" name="buy">
                            <?php
                            }
                            ?>
            </div>

            
            </form>
          </div>
        </div>
      </div>
  @endforeach
</div>


<section >
  @foreach($details_product as $key => $det_pro)
  <div class="product_image_area section_padding">
    <div class="container">
      <div class="row s_product_inner justify-content-between">
        <div class="col-lg-7 col-xl-7">
          <div class="product_slider_img">
            <div class="lSSlideOuter  vertical" style="padding-right: 105px;">
              <div class="lSSlideWrapper usingCss" style=" transition-duration: 600ms; transition-timing-function: ease;">
                <div id="vertical" class="lightSlider lsGrab lSSlide" style="height: 1800px; transform: translate3d(0px, 0px, 0px);">
                @foreach($gallery_productsdetail as $key =>$gal) 
                  <div data-thumb="{{ asset('public/uploads/gallery/'.$gal->images_detail) }}" class="lslide " style=" margin-bottom: 0px;">
                    <img class="zoom" src="{{ asset('public/uploads/gallery/'.$gal->images_detail) }}">
                  </div>
                  @endforeach
                </div>
                <div class="lSAction"><a class="lSPrev"></a><a class="lSNext"></a></div>  
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-5 col-xl-5">
          <div class="s_product_text">
            <h5>previous <span>|</span> next</h5>
            <ul class="list-inline" title="Average Rating">
              @for($count = 1; $count <=5; $count++)
                @php
                  if($count <= $rating){
                    $color = 'color:#ffcc00;';
                  }
                  else{
                    $color = 'color:#ccc;';
                  }
                @endphp
              <li title = "" 
              class="rating list-inline-item" 
              style="cursor:pointer; {{$color}} font-size: 30px;">&#9733;
              </li>
              @endfor
            </ul>
            <h3 style="color: #6e5f4b">{{$det_pro->product_name}}</h3>
            <h2 style="color: black"><?php
                                                    
                   if($det_pro->discount_percent > 0) {
                  ?>
                    <span style="text-decoration: line-through;color: #c8c8d3;">{{'$'.number_format($det_pro->product_price).'.'.'99'}}</span>
                    
                    <?php
                     $price=(($det_pro->product_price)*(100-($det_pro->discount_percent)))/100;
                        echo "$", $price;
                      
                    }else{
                    ?>
                    {{'$'.number_format($det_pro->product_price).'.'.'99'}}
                    <?php
                    }
                    ?>
                    </h2>
            <ul class="list">
              <li>
                <a class="active" href="#" style="color: black">
                  <span>Category</span>: {{$det_pro->categor_name}}</a>
              </li>
              <li>
                <a href="#"> <span>Availibility</span> : In Stock</a>
              </li>
            </ul>
            <p>
              First replenish living. Creepeth image image. Creeping can't, won't called.
              Two fruitful let days signs sea together all land fly subdue
            </p>


            <form action="{{URL::to('/save-cart')}}"method ="POST">
                {{csrf_field()}}

              <div class="card_area d-flex justify-content-between align-items-center">
                <div class="product_count">
                  <span class="inumber-decrement"> <i class="bi bi-dash"></i></span>
                  <input name="quantity" class="input-number" type="text" value="1" min="0" max="10">
                  
                  <span class="number-increment"> <i class="bi bi-plus"></i></span>
                  <input name="productid_hidden" type ="hidden" value="{{$det_pro ->product_id}}" />
                </div>
                              <?php
                                $customer_id= Session::get('customer_id');
                                if($customer_id==NULL) {

                             ?>
                             <a style="background-color: #57bad1;border: 2px solid #508fad" class="btn_3" href="{{URL::to('/login_customer')}}">add to cart</a>    
                             <a style="background-color: #57bad1;border: 2px solid #508fad" class="btn_3" href="{{URL::to('/login_customer')}}">buy</a>    
                            <?php
                            }else {
                            ?>
                            <input style="background-color: #57bad1;border: 2px solid #508fad" type="submit" class="btn_3" value="add to cart" name="add_cart">
                        
                            <a style="background-color: #57bad1;border: 2px solid #508fad" class="btn_3" onclick="myFunction()">buy</a>    
                            <?php
                            }
                            ?>

                <!-- <input type="submit" class="btn_3" value="add to cart" name="add_cart"> -->
                <a href="#" class="background_love"> <i class="bi bi-heart-fill"></i> </a>
            </div>

            
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <section class="product_description_area">
    <div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Description</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Specification</a>
        </li> -->
        
        <li class="nav-item">
          <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
            aria-selected="false">Comments</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
          <p>
           {!!$det_pro->product_desc!!} <!-- dấu !! dành cho những việc viết mà có kí tự đặc biệt -->
          <br>

            ABC is one of Britain’s most talented and amusing artists
            .Beryl’s pictures feature women of all shapes and sizes enjoying
            themselves .Born between the two world wars, Beryl Cook eventually
            left Kendrick School in Reading at the age of 15, where she went
            to secretarial school and then into an insurance office. After
            moving to London and then Hampton, she eventually married her next
            door neighbour from Reading, John Cook. He was an officer in the
            Merchant Navy and after he left the sea in 1956, they bought a pub
            for a year before John took a job in Southern Rhodesia with a
            motor company. Beryl bought their young son a box of watercolours,
            and when showing him how to use it, she decided that she herself
            quite enjoyed painting. John subsequently bought her a child’s
            painting set for her birthday and it was with this that she
            produced her first significant work, a half-length portrait of a
            dark-skinned lady with a vacant expression and large drooping
            breasts. 
          </p>
          
        </div>
        <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
          <div class="row">
            <div class="col-lg-6">
              <div class="row total_rate">
                <div class="col-6">
                  <div class="box_total">
                    <h5>Overall</h5>
                    <h4>4.0</h4>
                    <h6>(03 Reviews)</h6>
                  </div>
                </div>
                <div class="col-6">
                  <div class="rating_list">
                    <h3>Based on 3 Reviews</h3>
                    <ul class="list">
                      <li>
                        <a href="#">5 Star
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i> 01</a>
                      </li>
                      <li>
                      <a href="#">4 Star
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i> 01</a>
                      </li>
                      <li>
                      <a href="#">3 Star
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i>
                          <i class="bi bi-star"></i> 01</a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
              </div>
              <div class="review_list">
                <div class="review_item">
                  <div class="media">
                    <div class="d-flex">
                      <img src="img/product/single-product/review-1.png" alt="" />
                    </div>
                    <div class="media-body">
                      <h4>Blake Ruiz</h4>
                      <i class="bi bi-star"></i>
                      <i class="bi bi-star"></i>
                      <i class="bi bi-star"></i>
                      <i class="bi bi-star"></i>
                      <i class="bi bi-star"></i>
                    </div>
                  </div>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo
                  </p>
                </div>
                
                
                  <div class="form-group">
                  <?php
                                    $customer_id= Session::get('customer_id');
                                    
                                    if($customer_id==NULL ) {

                                ?> 
                                <p></p>
                                <?php
                                }else {
                                ?>
                    <label for="rating"> Rating</label>
                    
                    <ul class="list-inline" title="Average Rating">
                      @for($count = 1; $count <=5; $count++)
                      @php
                        
                          $color = 'color:#ffcc00;';
                        
                      @endphp
                      
                                <li title = "star_rating" 
                                  id = "{{$det_pro->product_id}}" 
                                  data-index="{{$count}}"
                                  data-product_id ="{{$det_pro->product_id}}" 
                                  data-customer_id ="{{$customer_id}}" 
                                  data-rating ="{{$rating_cmmt}}"
                                  class="rating_cmmt list-inline-item" 
                                  style="cursor:pointer; {{$color}} font-size: 30px;">&#9733;
                                </li>
                                @endfor
                                <?php
                                }
                                
                                ?>
                     
                      
                    </ul>
                    <form action="{{URL::to('/save-cmmt/'.$det_pro->product_id)}}"method ="POST">
                    {{csrf_field()}}

                    <label for="comment">Comment:</label>
                    <textarea name="cmmt_rating" class="form-control" rows="5" id="comment"></textarea>
                                <br>
                                  <?php
                                    $customer_id= Session::get('customer_id');
                                    
                                    if($customer_id==NULL ) {

                                ?> 
                                <a style="background-color: #57bad1; border: 2px solid #57bad1; margin-left: 80%" class="btn_3" href="{{URL::to('/login_customer')}}">SUBMIT</a>    
                                
                                <?php
                                }else {
                                ?>
                                <input style="background-color:#57bad1; border: 2px solid #57bad1;margin-left: 80%" type="submit" class="btn_3" value="submit" name="add_cart">
                                <?php
                                }
                                ?>

                
                  </div>

            
            </form>
                
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach
  <!-- product_list part start-->
 <section class="product_list best_seller section_padding">
 
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section_tittle text-center">
                        <h2>Related Products <span>shop</span></h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-12">
                    <div class=" best_product_slider owl-carousel" >
                    @foreach($related_products as $key => $related)
                        <div class="single_product_item" style="background: linear-gradient(to bottom,#fff 0%,#f7f7f7 100%);" >
                                                    
                            <div class="product_image" style="position: relative; height:300px; weight: 250px; text-align: center;">
                                <?php
                                                    
                                    if($related->discount_percent >0) {
                                ?>
                                     <div class="discount_product" >-{{$related->discount_percent}}%</div>
                                                        
                                     <?php
                                     }
                                ?>
                                       <br> <br>     
                                <a href="{{URL::to('/product_details/'.$related->product_id)}}" >  
                                <img src="{{URL::to('public/uploads/product/'.$related->product_image)}}" alt="">
                                </a>
                                            
                            </div>
                            <div class="single_product_text"   >
                                <h4 style="color:#17a2b8" >{{$related->product_name}}</h4>
                                <h3 style="color:#17a2b8" >
                                                <?php
                                                    
                                                    if($related->discount_percent > 0) {
                                                ?>
                                                <span style="text-decoration: line-through;color: #4abdcfb0;">{{'$'.number_format($related->product_price).'.'.'99'}}</span>
                                                <?php
                                                        $price=(($related->product_price)*(100-($related->discount_percent)))/100;
                                                            echo "$", $price ;
                                                    
                                                    }else{
                                                ?>
                                                {{'$'.number_format($related->product_price).'.'.'99'}}
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
  
  
  
  <!--================End Product Description Area =================-->
  @endsection 
<!-- <script src="{{ asset('public/frontend/js/js_2/jquery.min.js') }}"></script> -->



<div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="8RYmjQsT"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
      function remove_background(product_id)
        {
            for(var count = 1; count <= 5; count ++){
                $('#'+product_id+'-'+count).css('color','#ccc');
            }
        }
        $(document).ready(function(){
            $(".rating_cmmt").hover(function(){
                var index = $(this).data('index');
                var product_id = $(this).data('product_id');
                var customer_id = $(this).data('customer_id');
                remove_background(product_id);
                for(var count = 1; count <= index; count ++){
                  console.log(index);
                    $('#'+product_id+'-'+count).css('color','#ffcc00');
                }
            });
        });
        $(document).ready(function(){
            $(".rating_cmmt").hover(function(){
                var index = $(this).data('index');
                var product_id = $(this).data('product_id');
                var customer_id = $(this).data('customer_id');
                var rating = $(this).data('rating');
                remove_background(product_id);
                for(var count = 1; count <= rating; count ++){
                    $('#'+product_id+'-'+count).css('color','#ffcc00');
                }
            });
        });
        // $(document).on('mouseleave','.rating_cmmt', function(){
        //     var index = $(this).data("index");
        //     var product_id = $(this).data('product_id');
        //     var customer_id = $(this).data('customer_id');
        //     var rating = $(this).data('rating');
        //     remove_background(product_id);
        //     for(var count = 1; count <= rating; count ++){
        //         $('#'+product_id+'-'+count).css('color','#ffcc00');
        //     }
        // });
        $(document).ready(function(){
            $("li.rating_cmmt").click (function(){
                var index = $(this).data("index");
                var product_id = $(this).data('product_id');
                var customer_id = $(this).data('customer_id');
                var _token = $('input[name = "_token"]').val();
                $.ajax({
                    url:'{{url('/insert_rating')}}',
                    method:"POST",
                    data:{index:index, product_id:product_id,customer_id:customer_id,_token:_token},
                    success:function(data){
                        $(document).ready(function(){
                            $('.rating_cmmt').mouseleave(function(){
                                var index = $(this).data('index');
                                var product_id = $(this).data('product_id');
                                var customer_id = $(this).data('customer_id');
                                remove_background(product_id);
                                for(var count = 1; count <= index; count ++){
                                    $('#'+product_id+'-'+count).css('color','#ffcc00');
                                }
                            });
                        });
                    }
                    })
            });
        });


        
          function myFunction() {
            
            document.getElementById("bill").style.display = "block";
            document.getElementById("body").style.background = "#9797a3a6";
          };
          function myFunction_exitbuy() {
            
            document.getElementById("bill").style.display = "none";
            document.getElementById("body").style.background = "white";
          };
        

        // $(document).on('click','.rating_cmmt', function(){
        //     var index = $(this).data("index");
        //     var product_id = $(this).data('product_id');
        //     var customer_id = $(this).data('customer_id');
        //     var _token = $('input[name = "_token"]').val();
        //      $.ajax({
        //          url:'{{url('/insert_rating')}}',
        //          method:"POST",
        //          data:{index:index, product_id:product_id,customer_id:customer_id,_token:_token},
        //          success::function(data){
        //             $(document).on('mouseleave','.rating_cmmt', function(){
        //                 var index = $(this).data("index");
        //                 var product_id = $(this).data('product_id');
        //                 var customer_id = $(this).data('customer_id');
                        
        //                 remove_background(product_id);
        //                 for(var count = 1; count <= index; count ++){
        //                     $('#'+product_id+'-'+count).css('color','#ffcc00');
        //                 }
        //             });
        //          }
        //         })
        // });
    </script>
    