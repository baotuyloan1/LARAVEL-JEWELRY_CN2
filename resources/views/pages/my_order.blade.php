<style>
    .main_menu {
    
    left: 0;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: #6e5f4b;
}
#delivered_order {
  display: none;
}
#cancel_order {
  display: none;
}



</style>


@extends('layout_home')
@section('contents')
<section class="confirmation_part padding_top">
    <div class="container">
        <div class="row" style="background-color:#114b58;border: 3px solid #0e1818;">
            <div class="col-lg-5 " style="border-right: 1px solid black">
            @foreach($info as $key => $info)
                <div  style="margin-top: 20px">
                  
                    <?php
                    if($info->customer_img != NULL){
                    ?>
                        <img src="{{URL::to('public/uploads/customer/'.$info->customer_img)}}" height="35" width ="35" class="rounded-circle"  alt=""> 
                    <?php
                    }else{
                        ?>
                        <img src="{{ asset('public/frontend/images/favicon.png') }}" height="35" width ="35" class="rounded-circle" alt=""> 
                        <?php
                    } ?> <span style="font-size:20px;margin-left: 20px; ">  <b style="color:white">{{$info->customer_name}}</b> </span>
                        <h5 style="margin-left: 50px; color: white">{{$info->customer_email}}</h5>
                        <h5 style="margin-left: 50px;color: white">{{$info->customer_phone}}</h5>
                        <div class="row">
                            <div class="col-lg-6">
                            <button type="button" style="margin-top: 5%; margin-left: 50px; " class="btn btn-dark btn-s"> <a style="color:white" href="{{URL::to('/edit_customer/'.$info->customer_id)}} ">Edit Account</a> </button>
                            </div>
                            <div class="col-lg-6">
                            <button type="button" style="margin-top: 5%; margin-left: 50px" class="btn btn-dark btn-s"><a style="color:white" href="{{URL::to('/change_password/'.$info->customer_id)}} ">Change Password</a> </button>
                            </div>
                        </div>
                        <br>
                        
                </div>
            @endforeach
            </div>
            <div class="col-lg-7 ">
                <div >
                        <?php
                        $customer_id = Session::get('customer_id');
                        
                        if($bill_id=DB::table('tbl_billing')->where('tbl_billing.customer_id','=',$customer_id)->exists()) {
                        
                        ?>
                        <br>
                        <h4 style="color: white">Billing</h4>
                          <div >
                            @foreach($address_billing as $key =>$bill)  
                            <div class="form-check" style="text-align:left; color:white; ">
                              <label class="form-check-label" for="{{$bill->billing_id}}">
                              <h6 style="color: white">{{$bill->billing_name}} - {{$bill->billing_phone}}</h6>
                              {{$bill->billing_address}}
                              </label>
                              <hr style = "width:90%; ">
                            </div>
                            
                            @endforeach
                          </div> 
                        
                        <?php
                        }else {
                        ?>
                        <br>
                        <h6 style="color:#ff3368">Please add a shipping address to continue </h6> 
                        <hr style = "width:90%; ">
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
    <div class="container" >
        <div class="btn-group btn-group-justified">
            <button onclick="order_pro()" class="btn btn-outline-dark btn-lg">Processing</button>
            <button onclick="order_deli()" class="btn btn-outline-dark btn-lg">Delivered</button>
            <button onclick="order_cancel()" class="btn btn-outline-dark btn-lg">Cancel order</button>
        </div>
    </div>

    <section id ="processing_order" class="confirmation_part ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner" style="background-color:white">
                        <div class="cart_inner">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width:20px;">
                                        
                                        </th>
                                        <th style="color:#114b58 ">Customer Name</th>
                                        <th style="color: #114b58">Price Total</th>
                                        <th style="color: #114b58">Status</th>
                                        <th style="color: #114b58">Detail</th>
                                
                                        <th style="width:30px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($processing_order as $key =>$order_pro)
                                       
                                        <tr>
                                            
                                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                            <td> {{$order_pro->created_at}}
                                                <br>
                                                {{$order_pro->customer_name}}</td>
                                            <td>${{$order_pro->order_total}}</td>
                                            <td>{{$order_pro->order_status_name}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-warning" type="button"><a style="color: black" href="{{URL::to('/view_processing/'.$order_pro->order_id)}} ">View</a></button>
                                                <button class="btn btn-xs btn-dark" type="button"><a style="color: white" onclick  = "return confirm('Are you sure to cancel the order?')" href="{{URL::to('/cancel_order/'.$order_pro->order_id)}} ">Cancel</a></button>
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
        </div>
    </section> 
    
    
    <section id ="delivered_order" class="confirmation_part ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner" style="background-color:white;">
                        <div class="cart_inner">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width:20px;">
                                        <label class="i-checks m-b-none">
                                            <input type="checkbox"><i></i>
                                        </label>
                                        </th>
                                        <th style="color:#114b58 ">Customer Name</th>
                                        <th style="color: #114b58">Price Total</th>
                                        <th style="color: #114b58">Status</th>
                                        <th style="color: #114b58">Detail</th>
                                
                                        <th style="width:30px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($delivered_order as $key =>$order_deli)
                                       
                                        <tr>
                                            
                                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                            <td>{{$order_deli->updated_at}}
                                                <br>
                                                {{$order_deli->customer_name}}</td>
                                            <td>${{$order_deli->order_total}}</td>
                                            <td>{{$order_deli->order_status_name}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-warning" type="button"><a style="color: black" href="{{URL::to('/view_delivered/'.$order_deli->order_id)}} ">View</a></button>
                                                
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div> 
        </div>
    </section> 

    <section id ="cancel_order" class="confirmation_part ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details_iner" style="background-color:white;">
                        <div class="cart_inner">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width:20px;">
                                        <label class="i-checks m-b-none">
                                            <input type="checkbox"><i></i>
                                        </label>
                                        </th>
                                        <th style="color:#114b58 ">Customer Name</th>
                                        <th style="color: #114b58">Price Total</th>
                                        <th style="color: #114b58">Status</th>
                                        <th style="color: #114b58">Detail</th>
                                
                                        <th style="width:30px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cancel_order as $key =>$order_cancel)
                                        
                                        <tr>
                                            
                                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                            <td>{{$order_cancel->updated_at}}
                                                <br>
                                                {{$order_cancel->customer_name}}</td>
                                            <td>${{$order_cancel->order_total}}</td>
                                            <td>{{$order_cancel->order_status_name}}</td>
                                            <td>
                                                <button class="btn btn-xs btn-warning" type="button"><a style="color: black" href="{{URL::to('/view_cancel/'.$order_cancel->order_id)}} ">View</a></button>
                                                
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div> 
        </div>
    </section> 


                  
  @endsection
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    function order_pro()
    {
        document.getElementById("processing_order").style.display = "block";
        document.getElementById("delivered_order").style.display = "none";
        document.getElementById("cancel_order").style.display = "none";
    }

    function order_deli()
    {
        document.getElementById("processing_order").style.display = "none";
        document.getElementById("delivered_order").style.display = "block";
        document.getElementById("cancel_order").style.display = "none";
    }

    function order_cancel ()
    {
        document.getElementById("processing_order").style.display = "none";
        document.getElementById("delivered_order").style.display = "none";
        document.getElementById("cancel_order").style.display = "block";
    }

        document.getElementById("processing_order").style.display = "none";
        document.getElementById("delivered_order").style.display = "none";
        document.getElementById("cancel_order").style.display = "none";

  </script>
  