@extends('admin.admin_layout')
    @section('contentadmin')
            

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Discount
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
                    <form role="form" action="{{URL('/save_discount')}}" method="post" enctype = "multipart/form-data" > 
			            {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục Discount</label>
                            <select name='discount_object' class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                <option value ='{{$cate->categor_name}}'>{{$cate->categor_name}}</option>
                                @endforeach
                                        
                            </select>
                        </div>
                                
                        <div class="form-group">
                            <label for="exampleInputEmail1">Loại Discount</label>
                            <input type="text" data-validation="length" data-validation-length="min3"
                            data-validation-error_msg="Làm ơn điền ít nhất 3 kí tự" class="form-control" name="discount_name" id="text" placeholder="Tên danh mục">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Lượng Percent</label>
                            <input type="text" class="form-control" data-validation="length" data-validation-length="min1"
                            data-validation-error_msg="Làm ơn điền ít nhất 1 kí tự" name="discount_percent" id="text" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh Discount</label>
                            <input type="file" class="form-control" name="discount_image" id="text" >
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputFile">Hiển thị</label>
                            <select name='discount_status' class="form-control input-sm m-bot15">
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
                    <?php // để dòng message thông báo 
                                $message =Session::get('mess3');
                                if($message) {
                                    echo $message;
                                    Session::put('mess3',null);
                                }

                    ?>

        <section class="wrapper">
            <div class="table-agile-info">
                <div class="panel panel-default">               
                    <div class="panel-heading">
                        Liệt Kê Discount
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
                                    <th>Loại Discount</th>
                                    <th>Danh mục Discount</th>
                                    <th>Hình ảnh Discount</th>
                                    <th>Lượng Percent</th>
                                    <th>Hiển Thị</th>
                                    <th style="width:30px;"></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_discount as $key =>$pro)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                                    <td>{{$pro->discount_name}}</td>
                                    <td>{{$pro->discount_object}}</td>
                                    <td><img src="public/uploads/discount/{{$pro->discount_image}}" height="100" width ="100"></td>
                                    <td>{{$pro->discount_percent}}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                        <?php
                                        if($pro->status==0) {
                                        ?>     
                                            <button class="btn btn-sm btn-default" type="button"><a style="color: black" href="{{URL::to('/unactive-discount/'.$pro->discount_id)}}"> Ẩn</a></button>
                                        <?php
                                        }else {
                                        ?>    
                                            <button class="btn btn-sm btn-default" type="button"><a style="color: black" href="{{URL::to('/active-discount/'.$pro->discount_id)}}">Hiển thị</a></button>
                                        <?php
                                        }
                                        ?>                        
                                        </span></td>                       
                                    <td>
                                    <button class="btn btn-xs btn-success" type="button"><a style="color: black" href="{{URL::to('/edit_discount/'.$pro->discount_id)}} ">Edit</a></button>
                                    <button class="btn btn-xs btn-danger"  type="button"><a style="color: black" onclick  = "return confirm('Bạn có chắc xóa discount không?')" href="{{URL::to('/delete_discount/'.$pro->discount_id)}} ">Delete</a></button>
                                    
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