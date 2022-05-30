@extends('admin.admin_layout')
    @section('contentadmin')
            

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa Sản Phẩm
                        </header>
                        <div class="panel-body">
                        @foreach($edit_product as $key =>$edit)
                            <div class="position-center">
                            <form role="form" action="{{URL::to('/update-product/'.$edit->product_id)}}" method="post" enctype = "multipart/form-data" > 
			                        {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Tên danh mục sản phẩm</label>
                                    <select name='category_product' class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key => $cate)
                                            @if($cate->categor_id == $edit->categor_id)
                                            <option selected value ='{{$cate->categor_id}}'>{{$cate->categor_name}}</option>
                                            @else
                                            <option value ='{{$cate->categor_id}}'>{{$cate->categor_name}}</option>
                                            @endif

                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn điền ít nhất 3 kí tự"  value="{{$edit->product_name}}" class="form-control" name="product_name" id="text" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình sản phẩm</label>
                                    <input type="file" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn thêm ảnh" value="{{$edit->product_image}}" class="form-control" name="product_image" id="text" >
                                    <img src="{{URL::to('public/uploads/product/'.$edit->product_image)}}" height="100" width ="100">
                                
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style = "resize:none" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn mô tả sản phẩm"  type="password" class="form-control" name="product_desc" 
                                     placeholder="Mô tả sản phẩm"> {{$edit->product_desc}}  </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" data-validation="number" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn thêm giá sản phẩm"  value="{{$edit->product_price}}" class="form-control" name="product_price" id="text" placeholder="Tên danh mục">
                                </div>
                                @endforeach   
                                <button name= "edit_product" type="submit" class="btn btn-info">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>
                               
        </div>
        
            
    </div>

    @endsection    