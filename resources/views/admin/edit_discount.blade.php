@extends('admin.admin_layout')
    @section('contentadmin')
            

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa Discount
                        </header>
                        <div class="panel-body">
                        @foreach($edit_discount as $key =>$edit)
                            <div class="position-center">
                            <form role="form" action="{{URL::to('/update-discount/'.$edit->discount_id)}}" method="post" enctype = "multipart/form-data" > 
			                        {{csrf_field()}} <!-- Hàm này sẽ tạo ra 1 trường token để bảo mật hơn cho việc gửi form-->
                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Tên danh mục Discount</label>
                                    <select name='discount_object' class="form-control input-sm m-bot15">
                                        @foreach($cate_discount as $key => $cate)
                                            @if($cate->categor_name == $edit->discount_object)
                                            <option selected value ='{{$cate->categor_name}}'>{{$cate->categor_name}}</option>
                                            @else
                                            <option value ='{{$cate->categor_name}}'>{{$cate->categor_name}}</option>
                                            @endif

                                        @endforeach
                                        
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Loại Discount</label>
                                    <input type="text" data-validation="length" data-validation-length="min3"
                                    data-validation-error_msg="Làm ơn điền ít nhất 3 kí tự"  value="{{$edit->discount_name}}" class="form-control" name="discount_name" id="text" placeholder="Tên danh mục">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Lượng Percent</label>
                                    <input type="text" data-validation="length" data-validation-length="min1"
                                    data-validation-error_msg="Làm ơn điền ít nhất 1 kí tự" value="{{$edit->discount_percent}}" class="form-control" name="discount_percent" id="text" >
                                   
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image discount</label>
                                    <input type="file" value="{{$edit->discount_image}}"  class="form-control" name="edit_discount_image" id="text" >
                                    <img src="{{URL::to('public/uploads/discount/'.$edit->discount_image)}}" height="100" width ="100">
                                
                                </div>
                                
                                @endforeach   
                                <button name= "edit_discount" type="submit" class="btn btn-info">ADD</button>
                            </form>
                            </div>

                        </div>
                    </section>
                               
        </div>
        
            
    </div>

    @endsection    