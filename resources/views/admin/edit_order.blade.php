@extends('admin.admin_layout')
    @section('contentadmin')
            

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa Đơn Hàng
                        </header>
                        <div class="panel-body">
                        @foreach($order_edit as $key =>$edit)
                            <div class="position-center">
                            <form role="form" action="{{URL::to('/update-order/'.$edit->order_id)}}" method="post" enctype = "multipart/form-data" > 
			                        {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tài Khoản :</label>
                                    <br>
                                    <p class="border border-success" style="width:100% ; border: 1px solid black">{{$edit->customer_name}}</p>
                                   
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Tình Trạng Đơn Hàng :</label>
                                    <select name='category_order' style="border: 1px solid black"  class="form-control input-sm m-bot15">
                                        @foreach($cate_order as $key => $cate)
                                            @if($cate->order_status_id == $edit->order_status_id)
                                            <option selected value ='{{$cate->order_status_id}}'>{{$cate->order_status_name}}</option>
                                            @else
                                            <option value ='{{$cate->order_status_id}}'>{{$cate->order_status_name}}</option>
                                            @endif

                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Người Nhận :</label>
                                    <br>
                                    <p class="border border-success" style="width:100%; border: 1px solid black">{{$edit->billing_name}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá Đơn Hàng :</label>
                                    <br>
                                    <p class="border border-success" style="width:100% ; border: 1px solid black">{{$edit->order_total}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ghi Chú Đơn Hàng :</label>
                                    <textarea style = "resize:none; border: 1px solid black " data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn mô tả sản phẩm"  type="password" class="form-control" name="order_note" 
                                     placeholder="Mô tả sản phẩm"> {{$edit->order_note}}  </textarea>
                                </div>
                                @endforeach   
                                <button name= "edit_product" type="submit" class="btn btn-info">UPDATE</button>
                            </form>
                            </div>

                        </div>
                    </section>
                               
        </div>
        
            
    </div>

    @endsection    