@extends('admin.admin_layout')
    @section('contentadmin')
            

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
                        <header class="panel-heading">
                            Thêm Danh Mục Sản Phẩm
                        </header>
                        <?php // để dòng message thông báo 
                            $message =Session::get('message');
                            if($message) {
                                echo $message;
                                Session::put('message',null);
                            }

                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                            <form role="form" action="{{URL::to('/save-category-product')}}" method="post" enctype = "multipart/form-data"> <!-- admin-dashboard: hàm này tự truy cập đến cơ sở dữ liệu admin_tbl -->
			                        {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn điền ít nhất 3 kí tự"  class="form-control" name="category_product_name" id="text" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style = "resize:none" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn mô tả sản phẩm"  type="password" class="form-control" name="category_product_desc" 
                                     placeholder="Mô tả sản phẩm"> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa sản phẩm</label>
                                    <textarea style = "resize:none" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn mô tả sản phẩm"  type="password" class="form-control" name="category_product_keywords" 
                                    placeholder="Từ khóa sản phẩm"> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình danh mục</label>
                                    <input type="file"  class="form-control" name="category_product_image" id="text" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Hiển thị</label>
                                    <select name='category_product_status' class="form-control input-sm m-bot15">
                                        <option value ='0'>Ẩn</option>
                                        <option value ='1'>Hiện</option>
                                        
                                    </select>
                                </div>
                                
                                <button name= "add_category_product" type="submit" class="btn btn-info">ADD</button>
                            </form>
                            </div>

                        </div>
        </section>
                    <?php // để dòng message thông báo 
                                $message =Session::get('mess2');
                                if($message) {
                                    echo $message;
                                    Session::put('mess2',null);
                                }

                    ?>
 
        <section class="wrapper">
            <div class="table-agile-info">
                <div class="panel panel-default">               
                    <div class="panel-heading">
                        Liệt Kê Danh Mục Sản Phẩm
                    </div>
                        <?php // để dòng message thông báo 
                            $message =Session::get('mess');
                            if($message) {
                                echo $message;
                                Session::put('mess',null);
                            }

                        ?>
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
                                    <th>Tên danh mục</th>
                                    <th>Hình ảnh</th>
                                    <th>Hiển thị</th>
                            
                                    <th style="width:30px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_category_product as $key =>$cate_pro)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                    <td>{{$cate_pro->categor_name}}</td>
                                    <td><img src="public/uploads/category/{{$cate_pro->categor_image}}" height="100" width ="100"></td>
                                    <td>
                                        <span class="text-ellipsis">
                                        <?php
                                        if($cate_pro->categor_status==0) {
                                        ?>     
                                            <button class="btn btn-sm btn-default" type="button"><a style="color: black" href="{{URL::to('/unactive-category-product/'.$cate_pro->categor_id)}}"> Ẩn</a></button>
                                        <?php
                                        }else {
                                        ?>    
                                            <button class="btn btn-sm btn-default" type="button"><a style="color: black" href="{{URL::to('/active-category-product/'.$cate_pro->categor_id)}}">Hiển thị</a></button>
                                        <?php
                                        }
                                        ?>                        
                                        </span></td>                       
                                    <td>
                                    <button class="btn btn-xs btn-success" type="button"><a style="color: black" href="{{URL::to('/edit_cate_product/'.$cate_pro->categor_id)}} ">Edit</a></button>
                                    <button class="btn btn-xs btn-danger" type="button"><a style="color: black" onclick  = "return confirm('Bạn có chắc xóa sản phẩm không?')" href="{{URL::to('/delete_cate_product/'.$cate_pro->categor_id)}} ">Delete</a></button>
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
    </div>
            
</div>

    @endsection    