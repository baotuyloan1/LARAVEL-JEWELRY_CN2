<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Jewels</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name ='csrf-token' content="{{csrf_token()}}">
  <!-- Favicons -->
  <link href="{{ asset('public/frontend/images/favicon.png')}}" rel="icon">
  <link href="{{ asset('public/frontend/images/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('public/frontend/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{ asset('public/frontend/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('public/frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('public/frontend/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('public/frontend/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('public/frontend/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('public/frontend/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Css_2-->
 
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/animate.css') }}">
    <!-- nice select CSS -->
  <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/nice-select.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/lightslider.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/prettify.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/all.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/themify-icons.css') }}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/magnific-popup.css') }}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/rice_rangs.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('public/frontend/css/css_2/style.css') }}">


  <!-- Template Main CSS File -->
  <link href="{{ asset('public/frontend/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Flattern - v4.7.0
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body id ="body">

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1 class="text-light"><a href="index.html">ABC Jewel</a></h1>
      </div>

      <div id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="{{URL::to('/home')}}">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a  href="{{URL::to('/show_cart')}}">shopping cart</a></li>
          
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a href="contact.html">Contact</a></li>
          <li class="hearer_icon d-flex">
            <a id="search_1" href="javascript:void(0)"><i class="bi bi-search"></i></a>
                            
                            <?php
                                $customer_id= Session::get('customer_id');
                                $billing_id =Session::get('billing_id');
                                if($customer_id==NULL) {

                             ?> 
   
                            <a href="{{URL::to('/login_customer')}}"><i class="bi bi-bag-check-fill"></i></a>
                            
                            <?php
                            }else {
                            ?>
                            <a href="{{URL::to('/checkout')}}"><i class="bi bi-bag-check-fill"></i></a>    
                            <?php
                            }
                            ?>
                            
          </li>
          <li class="dropdown cart">
          <a  href="{{URL::to('/show_cart')}}" > 
            <i class="bi bi-cart"></i></a>
          </li>
          <li  class="dropdown cart" >
          <a href=""><i class="bi bi-person-lines-fill" data-toggle="dropdown" ></i></a>
                                <div class="dropdown-menu" style="background-color:black; width: 50px" aria-labelledby="navbarDropdown_2">
                                    <?php
                                        $customer_id= Session::get('customer_id');
                                        if($customer_id==NULL) {

                                    ?>   
                                    <a class="dropdown-item" style="font-size: 17px;background-color:black;width: 50px" href="{{URL::to('/login_customer')}}">My Order</a>
                                    <?php
                                    }else {
                                    ?>    
                                    
                                    <a class="dropdown-item" style="font-size: 17px;background-color:black;width: 50px" href="{{URL::to('/my_order')}}">My Order</a>
                                    <?php
                                    }
                                    ?>
                                    
                                   
                                    <?php
                                        $customer_id= Session::get('customer_id');
                                        if($customer_id==NULL) {

                                    ?>   
                                    <a class="dropdown-item" style="font-size: 17px;background-color:black;width: 50px" href="{{URL::to('/login_customer')}}"> Login</a>
                                    <?php
                                    }else {
                                    ?>    
                                    
                                    <a class="dropdown-item" style="font-size: 17px;background-color:black;width: 50px" href="{{URL::to('/logout_customer')}}">Logout </a>    
                                    <?php
                                    }
                                    ?>
                                </div>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </div><!-- .navbar -->
      <div class="search_input" id="search_input_box" style="display: block; background-color:white">
            <div class="container ">
                    <form  class="d-flex justify-content-between search-inner" action="{{URL::to('/search')}}" method="POST" >
                    {{csrf_field()}} 
                    <input type="text" style=" background-color:white"  class="form-control" id="search_input"  name="keysearch" placeholder="Search Here">
                     <button type="submit" class="btn"></button>
                    <span class="bi bi-x" id="close_search" title="Close Search"></span>
                    </form>
            </div>  
        </div>
    </div>
  </header><!-- End Header -->

  @yield('contents')

  <br><br>
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>ABC Jewel</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Flattern</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  <script src="{{ asset('public/frontend/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('public/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('public/frontend/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('public/frontend/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('public/frontend/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{ asset('public/frontend/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{ asset('public/frontend/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('public/frontend/js/main.js')}}"></script>


  <!-- Js_2-->

  <!-- jquery plugins here-->
  <script src="{{ asset('public/frontend/js/js_2/jquery-1.12.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('public/frontend/js/js_2/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('public/frontend/js/js_2/bootstrap.min.js') }}"></script>
    <!-- easing js -->
    <script src="{{ asset('public/frontend/js/js_2/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('public/frontend/js/js_2/swiper.min.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('public/frontend/js/js_2/masonry.pkgd.js') }}"></script>
    <!-- particles js -->
    <script src="{{ asset('public/frontend/js/js_2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/jquery.nice-select.min.js') }}"></script>
    <!-- slick js -->
    <script src="{{ asset('public/frontend/js/js_2/slick.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/waypoints.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/contact.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/jquery.form.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/mail-script.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/lightslider.js') }}"></script>
    <script src="{{ asset('public/frontend/js/js_2/prettify.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('public/frontend/js/js_2/custom.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
    <script src="{{asset('public/frontend/js/js_2/jquery.form-validator.min.js')}}"></script>
    
</body>
<script type="text/javascript">
        $(document).ready(function(){
            $('.add_cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{url('/add_cart')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                    success:function(data){

                        // swal({
                        //         title: "Đã thêm sản phẩm vào giỏ hàng",
                        //         text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                        //         showCancelButton: true,
                        //         cancelButtonText: "Xem tiếp",
                        //         confirmButtonClass: "btn-success",
                        //         confirmButtonText: "Đi đến giỏ hàng",
                        //         closeOnConfirm: false
                        //     },
                        //     function() {
                        //         window.location.href = "{{url('/cart')}}";
                        //     });
                        alert(data);
                    }

                });
            });
        });

        

    </script>
    

</html>