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
        <div class="card"  style="width: 600px">
    		<div class="card-header">Sample Product</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
      
    					<h1 class="text-warning mt-4 mb-4">
              @php
                $rating
                @endphp
             
    						<b><span >{{$rating}}</span> / 5</b>
    					</h1>
    					<div class="mb-3">
              @for($count = 1; $count <=5; $count++)
                @php
                  if($count <= $rating){
                    $color = 'color:#ffcc00;';
                  }
                  else{
                    $color = 'color:#ccc;';
                  }
                @endphp
                 <i class="bi bi-star star-light mr-1 main_star" style="cursor:pointer; {{$color}} f"></i>
                @endfor            
	    				</div>
    					<h3>Review</h3>
             
    				</div>
    				<!-- <div class="col-sm-4">
    					<p>
                            <div class="progress-label-left"><b>5</b> <i class="bi bi-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <div class="progress-label-left"><b>4</b> <i class="bi bi-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>3</b> <i class="bi bi-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>2</b> <i class="bi bi-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <div class="progress-label-left"><b>1</b> <i class="bi bi-star text-warning"></i></div>
                            
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div> -->
    				<div class="col-sm-4 text-center" style="margin-left: 100px">
    					<h4 class="mt-4 mb-3">Write Review Here</h4>
              <?php
                                $customer_id= Session::get('customer_id');
                                if($customer_id==NULL) {

                             ?>
                             <button type="button" href="{{URL::to('/login_customer')}}" id="add_review" class="btn btn-primary">Review</button>    
                            <?php
                            }else {
                            ?>
                            <button type="button" onclick="add_review()" id="add_review" class="btn btn-primary">Review</button>
                            <?php
                            }
                            ?>
    					
    				</div>
    			</div>
    		</div>
    	</div>
    <br> <br>

      <div class="col-lg-6">
              <div class="review_box">
                <h4>Post a comment</h4>
                @foreach($rating_review as $key => $rat)
                <div class="review_item">
                  <div class="media">
                    <div class="row" style="background-color: #82c1ee">
                    <?php
                    if($rat->customer_img != NULL){
                    ?>
                    <div class="col-sm-6">
                        <img src="{{URL::to('public/uploads/customer/'.$rat->customer_img)}}" height="35" width ="35" class="rounded-circle"  alt=""> <span style="font-size: 20px;margin-left: 5px">{{$rat ->customer_name}}</span> 
                        
                    </div>
                    <div  class="col-sm-6">
                    <span style="margin-left: 100px;color: black">{{$rat ->created_at_review}}</span>
                    </div>
                    <?php
                    }else{
                        ?>
                        <div class="col-sm-6">
                        <img src="{{ asset('public/frontend/images/anh_cua_hang.jpg') }}" height="35" width ="35" class="rounded-circle" alt=""> <span style="font-size: 20px;margin-left: 5px">{{$rat ->customer_name}}</span> 
                        </div>
                        <div class="col-sm-6" >
                        <span style="margin-left: 100px; color: black">{{$rat ->created_at_review}}</span>
                        </div>
                        <?php
                    } ?>
                    
                    </div>
                   
                      <div class="media-body" style=" margin-left: 10%">
                        

                        @for($count = 1; $count <=5; $count++)
                          @php
                          $rating_user = $rat->rating;
                            if($count <= $rating_user){
                              $color = 'color:#ffcc00;';
                            }
                            else{
                              $color = 'color:#ccc;';
                            }
                          @endphp
                        <i class="bi bi-star" style="{{$color}}"></i>
                        
                      @endfor
                      </div>
                      <span style=" margin-left: 10%">
                          {{$rat ->comments}}
                          </span>
                    </div>
                    
                    
                        
                </div>
                <hr>
                @endforeach
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
  
    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Review</h5>
	        	<button type="button" onclick="close_review()" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
          @foreach($details_product as $key => $det_pro)
          
          <?php
          $customer_id_2= Session::get('customer_id');
          
          ?>
	      	<div class="modal-body">
	      		<h4 class="text-center mt-2 mb-4">
	        	      	<i class="bi bi-star star-light submit_star mr-1" data-customer_id="{{$customer_id_2}}" data-product_id="{{$det_pro->product_id}}"  id="submit_star_1" data-rating="1"></i>
                    <i class="bi bi-star star-light submit_star mr-1" data-customer_id="{{$customer_id_2}}" data-product_id="{{$det_pro->product_id}}" id="submit_star_2" data-rating="2"></i>
                    <i class="bi bi-star star-light submit_star mr-1" data-customer_id="{{$customer_id_2}}" data-product_id="{{$det_pro->product_id}}" id="submit_star_3" data-rating="3"></i>
                    <i class="bi bi-star star-light submit_star mr-1" data-customer_id="{{$customer_id_2}}" data-product_id="{{$det_pro->product_id}}" id="submit_star_4" data-rating="4"></i>
                    <i class="bi bi-star star-light submit_star mr-1" data-customer_id="{{$customer_id_2}}" data-product_id="{{$det_pro->product_id}}" id="submit_star_5" data-rating="5"></i>
	        	</h4>
            @foreach($customer as $key => $cus)
	        	<div class="form-group">
	        		<h1 >{{$cus->customer_name}}</h1>
	        	</div>
            @endforeach
	        	<div class="form-group">
	        		<textarea name="user_review"   id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
            
            <button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
         
         @endforeach
    	</div>
  	</div>
</div>

  
  <!--================End Product Description Area =================-->
  @endsection 
<!-- <script src="{{ asset('public/frontend/js/js_2/jquery.min.js') }}"></script> -->



<div id="fb-root"></div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
      var rating_data = 0;
      var product_id =0;
      var customer_id =0;
      

      
      function add_review() {
            
             document.getElementById("review_modal").style.display = "block";
          
            document.getElementById("body").style.background = "#9797a3a6";
          };
      $(document).on('mouseenter', '.submit_star', function(){

          var rating = $(this).data('rating');

          reset_background();

          for(var count = 1; count <= rating; count++)
          {

              $('#submit_star_'+count).addClass('text-warning');

          }

          });

          function reset_background()
          {
          for(var count = 1; count <= 5; count++)
          {

              $('#submit_star_'+count).addClass('star-light');

              $('#submit_star_'+count).removeClass('text-warning');

          }
          }

          $(document).on('mouseleave', '.submit_star', function(){

          reset_background();

          for(var count = 1; count <= rating_data; count++)
          {

              $('#submit_star_'+count).removeClass('star-light');

              $('#submit_star_'+count).addClass('text-warning');
          }

          });

          $(document).on('click', '.submit_star', function(){

          rating_data = $(this).data('rating');
          product_id = $(this).data('product_id');
          customer_id = $(this).data('customer_id');
          
          });

          $(document).ready (function() {
                    $(document).on('click','#save_review', function() {
                        var user_review = $('#user_review').val();
                        var data_rating = rating_data;
                        var id_product = product_id;
                        var id_customer = customer_id;
                        var _token =$('input[name="_token"]').val();
                        if(user_review==''){
                          alert("Please Fill Both Field");
                          return false;
                        }else{
                            $.ajax({
                            url:"{{url('/review_rating')}}",
                            method: "POST",
                            data:{data_rating:data_rating,id_customer:id_customer, id_product:id_product,user_review:user_review,_token:_token},

                            success:function(data) {
                              
                              document.getElementById("review_modal").style.display = "none";
                              document.getElementById("body").style.background = "white";
                        }
                        });
                      }

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
          function close_review() {
            
            document.getElementById("review_modal").style.display = "none";
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
    