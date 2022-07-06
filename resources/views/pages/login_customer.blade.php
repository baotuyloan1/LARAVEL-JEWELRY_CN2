@extends('layout_home')
@section('contents')


    <section class="breadcrumb breadcrumb_bg" style=" background-image: url({{ asset('public/frontend/images/breadcrumb5.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Tracking Order</h2>
                            <p>Home <span>-</span> Tracking Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
                            
    <section class="login_part padding_top">
        <div class="container">
        <div style="color: #ff3368; font-size: 20px ;font-style: normal; text-align: center">
            <?php // để dòng message thông báo 
                $message =Session::get('mess3');
                if($message) {
                    echo $message;
                        Session::put('mess3',null);
                }

            ?>
            <?php // để dòng message thông báo 
                $message =Session::get('mess1');
                if($message) {
                    echo $message;
                        Session::put('mess1',null);
                }

            ?>
        </div>
        <br><br>
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6" >
                    <div class="login_part_text ">
                        <h3 style="text-align: center" >Register </h3>
                        <form id="form-register" class="row contact_form" action="{{URL::to('/register_customer')}}" method="POST"   novalidate="novalidate">
                        {{csrf_field()}} 
                        
                        <h6  >Name</h6>
                            <div class="col-md-12 form-group ">
                            <input type="text" class="form-control" data-validation="length" data-validation-length="min2"
                            data-validation-error_msg="Làm ơn điền ít nhất 2 kí tự" id="name_customer" name="name_customer" >
                            <span class="placeholder" ></span>
                            </div>
                        <h6 >Password</h6>
                            <div class="col-md-12 form-group ">
                            <input type="password" class="form-control" data-validation="length" data-validation-length="min8"
                            data-validation-error_msg="Làm ơn điền ít nhất 8 kí tự" id="password_customer" name="password_customer" value="" >
                            <span class="placeholder"></span>
                            </div>
                        <h6>Phone Number</h6> 
                            <div class="col-md-12 form-group ">
                            <input style="text-align: center" type="number" class="form-control" data-validation="length" data-validation-length="min10"
                            data-validation-error_msg="Làm ơn điền ít nhất 10 kí tự" class="form-control" id="phone_customer" name="phone_customer">
                            <span class="placeholder" data-placeholder="Phone number"></span>
                            </div>
                        <h6>Email</h6> 
                            <div class="col-md-12 form-group ">
                            <input type="email"  class="form-control" id="customer_email" name="customer_email"  >
                            <span id="text" class="placeholder" data-placeholder="Email Address"></span>
                            <p style="color: white; font-style: italic; text-align: left">
                            <?php // để dòng message thông báo 
                                $message =Session::get('mess2');
                                if($message) {
                                    echo $message;
                                    Session::put('mess2',null);
                                }

                            ?>
                            </p>
                        </div>
                        <div style="text-align: center" class="col-md-12 form-group">
                            <div class="creat_account">
                            <input type="submit" class="tp_btn" name="create_account" value="Create an account">
                            </div>
                        </div>
                        </form>
                            <ul class="alert text-danger" style="text-align: center" >
                                @foreach ($errors->all() as $error)
                                    <li style="color:black">{{ $error }}</li>
                                @endforeach
                            </ul>
                        
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                                <h4 style="color: #ff3368;"><?php // để dòng message thông báo 
                                $message =Session::get('message');
                                if($message) {
                                    echo $message;
                                    Session::put('message',null);
                                }
                                ?></h4>
                                <h4 style="color: #ff3368;">
                                <?php // để dòng message thông báo 
                                $message =Session::get('mess');
                                if($message) {
                                    echo $message;
                                    Session::put('mess',null);
                                }

                                ?>
                                </h4>
                                
                            <form class="row contact_form" action="{{URL::to('/login')}}" method="POST" novalidate="novalidate">
                            {{csrf_field()}}
                            <h6 style="color: #ff3368;">User Name</h6>
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control"  name="email_account" value="" placeholder="Username">
                                </div>
                                <h6 style="color: #ff3368;">Password</h6>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password"  class="form-control"name="password_account" value="" placeholder="Password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" value="remember" id="f-option" name="remember">
                                        <label for="f-option">Remember me</label>
                                    </div>
                                    <button type="submit" class="btn_3"> log in</button>
                                    <a class="lost_pass" href="{{URL::to('/forget-pass')}}">forget password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
    