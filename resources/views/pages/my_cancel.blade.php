<style>
    .main_menu {
    
    left: 0;
    top: 0;
    width: 100%;
    z-index: 999;
    background-color: #6e5f4b;
}
.confirmation_part .order_details {
    margin-top: 50px;
    border: #ef3278 solid 2px;
    padding: 30px 30px 15px;
    text-transform: capitalize;
}
</style>

@extends('layout_home')
@section('contents')


    <section class="confirmation_part padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details">
                        <h3>Thông Tin Billing</h3>  
                        <div class="cart_inner">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            
                                            <th>Tên Người Nhận</th>
                                            <th>Địa chỉ</th>
                                            <th>Số Điện Thoại</th>
                                            <th style="width:30px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                            <td>{{$order_by_id->billing_name}}</td>
                                            <td>{{$order_by_id->billing_address}}</td>
                                            <td>{{$order_by_id->billing_phone}}</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
                <br> <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order_details" style="background-color:#4e390391;">
                        <h3>Liệt Kê Chi Tiết Sản Phẩm</h3>  
                        <div class="cart_inner">
                            <div class="table-responsive">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th style="width:20px;">
                                            <label class="i-checks m-b-none">
                                                <input type="checkbox"><i></i>
                                            </label>
                                            </th>
                                            <th style="color: white">Tên Sản Phẩm</th>
                                            <th style="color: white">Số Lượng</th>
                                            <th style="color: white">Giá</th>
                                            <th style="color: white">Tổng Tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($detail_order as $key => $order_detail )
                                        <tr>
                                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                            <td>{{$order_detail->created_at}}
                                                <br>
                                                {{$order_detail->product_name}}</td>
                                            <td>{{$order_detail->product_sales_quantity}}</td>
                                            <td>{{$order_detail->product_price}}</td>
                                            <td>{{$order_detail->product_price*$order_detail->product_sales_quantity}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>


 @endsection