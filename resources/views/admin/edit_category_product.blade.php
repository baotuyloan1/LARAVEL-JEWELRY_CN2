@extends('admin.admin_layout')
    @section('contentadmin')


<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa Danh Mục Sản Phẩm
                        </header>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key =>$edit_value)
                            <div class="position-center">
                            <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->categor_id)}}" method="post" enctype = "multipart/form-data"> <!-- admin-dashboard: hàm này tự truy cập đến cơ sở dữ liệu admin_tbl -->
			                        {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" data-validation="length" data-validation-length="min3"
                                     data-validation-error_msg="Làm ơn điền ít nhất 3 kí tự" value="{{$edit_value->categor_name}}" class="form-control" name="category_product_name" id="text" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình sản phẩm</label>
                                    <input type="file" value="{{$edit_value->categor_image}}"  class="form-control" name="edit_category_product_image" id="text" >
                                    <img src="{{URL::to('public/uploads/category/'.$edit_value->categor_image)}}" height="100" width ="100">
                                
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style = "resize:none" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn mô tả sản phẩm"   type="password" class="form-control" name="category_product_desc" 
                                    > {{$edit_value->categor_desc}} </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa sản phẩm</label>
                                    <textarea style = "resize:none" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn mô tả sản phẩm"  type="password" class="form-control" name="category_product_keywords" 
                                    placeholder="Từ khóa sản phẩm"> {{$edit_value->meta_keywords}} </textarea>
                                </div>
                                 @endforeach
                                <button name= "edit_category_product" type="submit" class="btn btn-info">EDIT</button>
                            </form>
                            </div>

                        </div>
                    </section>

                    @endsection                     