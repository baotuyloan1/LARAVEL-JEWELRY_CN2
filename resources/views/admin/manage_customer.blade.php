@extends('admin.admin_layout')
    @section('contentadmin')
    <?php // để dòng message thông báo đăng nhập sai
		
        $mess1 =Session::get('mess1');
		if($mess1) {
			echo $mess1;
			Session::put('mess1',null);
		}
		?>
    <section class="wrapper">
                    <div class="table-agile-info">
                    <div class="panel panel-default">               
                <div class="panel-heading">
                Liệt Kê Đơn Hàng
                </div>
                        
                <div class="row w3-res-tb">
                <div class="col-sm-5 m-b-xs">
                    <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                    </select>
                    <button class="btn btn-sm btn-default">Apply</button>                
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-3">
                    <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
                </div>
                <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>
                        <th style="width:20px;">
                        <label class="i-checks m-b-none">
                            <input type="checkbox"><i></i>
                        </label>
                        </th>
                        <th>Tên Khách Hàng</th>
                        <th>Hình Ảnh</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Biling</th>
                        
                        <th style="width:30px;"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($all_customer as $key =>$cust_pro)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$cust_pro->created_at}}
                            <br>
                            {{$cust_pro->customer_name}}</td>
                        <td><img src="public/uploads/customer/{{$cust_pro->customer_img}}" height="100" width ="100"></td>

                        <!-- đang sửa -->
                        <td name ="orderstatus_name">{{$cust_pro->customer_phone}}</td>
                        <td>{{$cust_pro->customer_email}}</td>  
                        <td>{{$cust_pro->billing_name}}
                            <br>
                            {{$cust_pro->billing_address}}
                            <br>
                            {{$cust_pro->billing_phone}}
                        </td> 
                        <td>
                        <button class="btn btn-xs btn-danger" type="button"><a style="color: black" onclick  = "return confirm('Bạn có chắc xóa khách hàng này không?')" href="{{URL::to('/delete_customer/'.$cust_pro->customer_id)}} ">Delete</a></button>
                        
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <footer class="panel-footer">
                <div class="row">
                    
                    <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">                
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                    </div>
                </div>
                </footer>
            </div>
            </div>
    </section>
@endsection