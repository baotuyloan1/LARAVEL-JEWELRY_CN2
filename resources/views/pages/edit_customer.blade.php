@extends('layout_home')
@section('contents')


    <section class="breadcrumb breadcrumb_bg" style=" background-image: url({{ asset('public/frontend/images/anh_cua_hang.jpg') }});">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                </div>
            </div>
        </div>
    </section>
                            
    <section class="login_part padding_top">
        <div class="container">
        <div style="color: #ff3368; font-size: 20px ;font-style: normal; text-align: center">
            
            <?php // để dòng message thông báo 
                $message =Session::get('mess1');
                if($message) {
                    echo $message;
                        Session::put('mess1',null);
                }

            ?>
        </div>
            <div class="row align-items-center" >
                <div class="col-lg-6 col-md-6">
                    <div  style="background-color:#114b58; color: white" >
                    <br><br>
                        <h3 style="text-align: center; color: white">EDIT ACCOUNT</h3>
                        @foreach($edit_account as $key => $edit_acc)
                        <form id="form-edit" class="row contact_form" action="{{URL::to('/update_customer/'.$edit_acc->customer_id)}}" method="POST" enctype = "multipart/form-data"  novalidate="novalidate">
                        {{csrf_field()}} 
                            <h3 style="margin-left: 3%;color: white">Image</h3>
                                <div class="col-md-12 form-group ">
                                    <input style="width:80%;margin-left:20px" type="file" value="{{$edit_acc->customer_img}}"  class="form-control" name="customer_img" id="text" >
                                    <br>
                                    <img style="margin-right: 72%" src="{{URL::to('public/uploads/customer/'.$edit_acc->customer_img)}}" height="100" width ="100">
                                    
                                </div>
                            
                            <h3 style="margin-left: 3%;color: white" >Name</h3>
                                <div class="col-md-12 form-group ">
                                <input style="width:80%;margin-left:20px" type="text" class="form-control" value="{{$edit_acc->customer_name}}" id="name_customer" name="name_customer">
                                <span class="placeholder" ></span>
                                </div>
                            
                            <h3 style="margin-left: 3%;color: white" >Phone Number</h3> 
                                <div class="col-md-12 form-group ">
                                <input style="width:80%;margin-left:20px" type="text" class="form-control" value="{{$edit_acc->customer_phone}}" id="phone_customer" name="phone_customer">
                                <span class="placeholder" data-placeholder="Phone number"></span>
                                </div>
                            <h3 style="margin-left: 3%;color: white" >Email</h3> 
                                <div class="col-md-12 form-group ">
                                <input style="width:80%;margin-left:20px" type="text" class="form-control" value="{{$edit_acc->customer_email}}" id="email_customer" name="email_customer">
                                <span class="placeholder" data-placeholder="Email Address"></span>
                                <p style="color: white; font-style: italic; text-align: left">
                                <?php 
                                //để dòng message thông báo 
                                    $message =Session::get('mess2');
                                    if($message) {
                                        echo $message;
                                        Session::put('mess2',null);
                                    }

                                ?>
                                </p>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="update_account" style =" text-align: center">
                                <input type="submit" class="tp_btn" name="update_account" value="Update an account">
                                </div>
                                <br>
                            </div>
                            
                        </form>
                        @endforeach
                        
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div style="background-color:#114b58; color: white " >
                    <br> <br>
                        <h3 style="text-align: center; color: white" >CHANGE PASSWORD</h3>
                        @foreach($edit_account as $key => $edit_acc)
                        <form id="form-edit" class="row contact_form" action="{{URL::to('/update_password/'.$edit_acc->customer_id)}}" method="POST" enctype = "multipart/form-data"  novalidate="novalidate">
                        {{csrf_field()}} 
                            <h3 style="margin-left: 3%; color: white"  >Name: <span>{{$edit_acc->customer_name}}</span> </h3> 
                            
                            <h3 style="margin-left: 3%; color: white" >Phone Number: <span>{{$edit_acc->customer_phone}}</span></h3> 
                               
                            <h3 style="margin-left: 3%;color: white" >Email: <span>{{$edit_acc->customer_email}}</span></h3> 
                            <br>
                            <br>
                            <h3 style="margin-left: 3%;color: white"  >Old Password</h3>
                                <div class="col-md-12 form-group ">
                                <input style="width:80%;margin-left:20px" type="password" class="form-control" value="" id="name_customer" name="password_customer">
                                <span class="placeholder" ></span>
                                <p style="color: white; font-style: italic; text-align: left">
                                <?php 
                                //để dòng message thông báo 
                                    $message =Session::get('mess3');
                                    if($message) {
                                        echo $message;
                                        Session::put('mess3',null);
                                    }

                                ?>
                                </p>
                                </div>
                            
                            <h3 style="margin-left: 3%; color: white">New Password</h3>
                                <div class="col-md-12 form-group ">
                                <input style="width:80%;margin-left:20px" type="password" class="form-control" value="" id="name_customer" name="new_password">
                                <span class="placeholder" ></span>
                                </div>
                            <div class="col-md-12 form-group">
                                <div class="update_account" style =" text-align: center">
                                <input type="submit" class="tp_btn" name="change_password" value="Change Password">
                                </div>
                                <br>
                            </div>
                        </form>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection