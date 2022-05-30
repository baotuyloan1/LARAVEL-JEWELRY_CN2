

@extends('admin.admin_layout')
    @section('contentadmin')
            

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Sản Phẩm
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
                    <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype = "multipart/form-data" > 
			            {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                
                        <div class="form-group">
                            <label for="exampleInputFile">Tên danh mục sản phẩm</label>
                            <select name='category_product' class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                <option value ='{{$cate->categor_id}}'>{{$cate->categor_name}}</option>
                                @endforeach
                                        
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Loại Discount</label>
                            <select name='discount_product' class="form-control input-sm m-bot15">
                                @foreach($discount_product as $key => $disc)
                                <option value ='{{$disc->discount_id}}'>{{$disc->discount_name}}({{$disc->discount_object}})</option>
                                @endforeach
                                        
                            </select>
                        </div>
                                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" data-validation="length" data-validation-length="min3"
                            data-validation-error_msg="Làm ơn điền ít nhất 3 kí tự" class="form-control" name="product_name" id="text" placeholder="Tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình sản phẩm</label>
                            <input type="file" class="form-control" name="product_image" id="text" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style = "resize:none" data-validation="length" data-validation-length="min3"
                            data-validation-error_msg="Làm ơn mô tả sản phẩm"  type="password" class="form-control" name="product_desc" 
                                   placeholder="Mô tả sản phẩm"> </textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-length="min3"
                            data-validation-error_msg="Làm ơn thêm giá sản phẩm" class="form-control" name="product_price" id="text" placeholder="Tên danh mục">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name='product_status' class="form-control input-sm m-bot15">
                                        <option value ='0'>Ẩn</option>
                                        <option value ='1'>Hiện</option>
                                        
                            </select>
                        </div>
                                
                        <button name= "add_category_product" type="submit" class="btn btn-info">ADD</button>
                    </form>
                </div>

            </div>
        </section>
                    
                    

        <section class="wrapper">
            <div class="table-agile-info">
                <div class="panel panel-default">               
                    <div class="panel-heading">
                        Liệt Kê Sản Phẩm
                    </div>
                        <?php // để dòng message thông báo 
                            $message =Session::get('mess');
                            if($message) {
                                echo $message;
                                Session::put('mess',null);
                            }

                        ?>
                        <?php // để dòng message thông báo 
                                $message =Session::get('mess2');
                                if($message) {
                                    echo $message;
                                    Session::put('mess2',null);
                                }

                    ?>
                    <?php // để dòng message thông báo 
                                $message =Session::get('mess3');
                                if($message) {
                                    echo $message;
                                    Session::put('mess3',null);
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
                        <div class="search-container">
                        <form  class="d-flex justify-content-between search-inner" action="{{URL::to('/search_product_admin')}}" method="POST" >
                            {{csrf_field()}} 
                            <input type="text"  placeholder="Search.." name="keysearch">
                            <button type="submit" style="border: 1px solid black" class="btn"><i  class="fa fa-search"></i></button>
                            </form>
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
                                    <th>Tên Sản Phẩm</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Loại Discount</th>
                                    <th>Giá Sản Phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Mô Tả Sản Phẩm</th>
                                    <th>Hiển Thị</th>
                                    <th></th>
                                    <th>Thư viện ảnh</th>
                                </tr>
                            </thead>
                            <tbody id = "listProduct">
                                @foreach($all_product as $key =>$pro)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                    <td>{{$pro->product_name}}</td>
                                    <td>{{$pro->categor_name}}</td>
                                    <td>{{$pro->discount_name}}</td>
                                    <td>{{$pro->product_price}}</td>
                                    <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width ="100"></td>
                                    <td>{{$pro->product_desc}}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                        <?php
                                        if($pro->product_status==0) {
                                        ?>     
                                            <button class="btn btn-sm btn-default" type="button"><a style="color: black" href="{{URL::to('/unactive-product/'.$pro->product_id)}}"> Ẩn</a></button>
                                        <?php
                                        }else {
                                        ?>    
                                            <button class="btn btn-sm btn-default" type="button"><a style="color: black" href="{{URL::to('/active-product/'.$pro->product_id)}}">Hiển thị</a></button>
                                        <?php
                                        }
                                        ?>                        
                                        </span></td>                       
                                    <td>
                                    <button class="btn btn-xs btn-success" type="button"><a style="color: black" href="{{URL::to('/edit_product/'.$pro->product_id)}} ">Edit</a></button>
                                    <button class="btn btn-xs btn-danger"  type="button"><a style="color: black" onclick  = "return confirm('Bạn có chắc xóa sản phẩm không?')" href="{{URL::to('/delete_product/'.$pro->product_id)}} ">Delete</a></button>
                                    
                                    </td>
                                    <td>
                                    <button class="btn btn-xs btn-warning" type="button"><a style="color: black" href="{{URL::to('/imagesdetail/'.$pro->product_id)}} ">Add ImagesDetail</a></button>
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
    