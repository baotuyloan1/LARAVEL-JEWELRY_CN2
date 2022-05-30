@extends('admin.admin_layout')
    @section('contentadmin')
    <!-- Yêu cầu chọn file ảnh cho thư viện -->
    <script type="text/javascript">
        $(document).ready (function() {
            $('#file').change(function() {
                var error= '';
                var files = $('#file')[0].files;

                if(files.length>4) {
                    error+='<p>Bạn chọn tối đa chỉ được 4 ảnh</p>';
                }else if (files.length=='') {
                    error+='<p>Bạn không được bỏ trống ảnh</p>'
                } else if (files.size>2000000) {
                    error+='<p>File ảnh không được lớn hơn 2MB</p>'
                }
                if(error=='') {

                }else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+' </span>');
                    return false;
                }
            });
        });

    </script> 
    <!-- Chỉnh sửa tên ảnh thư viện -->
    <script type="text/javascript">
        $(document).ready (function() {
            $(document).on('blur','.edit_gal_name', function() {
                var gal_id= $(this).data('gal_id');
                var gal_text= $(this).text();
                var _token =$('input[name="_token"]').val();
                $.ajax({
                url:"{{url('/update-gallery-name')}}",
                method: "POST",
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data) {
                   // load_gallery();
                    var imagesdetail_id =$('.imagesdetail_id').val();
                    var _token =$('input[name="_token"]').val();
                    $.ajax({
                        url:"{{url('/select-gallery')}}",
                        method: "POST",
                        data:{imagesdetail_id:imagesdetail_id,_token:_token},
                        success:function(data) {
                        $('#gallery_load').html(data);
                        }
                    });
                $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            });

            });
        });

    </script> 
<!-- Xóa 1 mục thư viện ảnh -->
        <script type="text/javascript">
                $(document).ready (function() {
                    $(document).on('click','.delete-gallery', function() {
                        var gal_id= $(this).data('gal_id');
                        var _token =$('input[name="_token"]').val();
                        if(confirm('Bạn muốn xóa hình ảnh này không')) {
                        $.ajax({
                        url:"{{url('/delete-gallery-name')}}",
                        method: "POST",
                        data:{gal_id:gal_id,_token:_token},
                        success:function(data) {
                            //load_gallery();
                            var imagesdetail_id =$('.imagesdetail_id').val();
                            var _token =$('input[name="_token"]').val();
                            $.ajax({
                                url:"{{url('/select-gallery')}}",
                                method: "POST",
                                data:{imagesdetail_id:imagesdetail_id,_token:_token},
                                success:function(data) {
                                $('#gallery_load').html(data);
                                }
                            });
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                        }
                        });
                        }

                    });
                });

        </script> 
            <!-- Thay đổi ảnh tại thư viện ảnh -->
        <script type="text/javascript">
                $(document).ready (function() {
                    $(document).on('change','.file_image', function() {
                        var gal_id= $(this).data('gal_id');
                        var image= document.getElementById('file-'+gal_id).files[0];
                        var form_data = new FormData(); // Tạo 1 cái form mới
                        form_data.append('file',document.getElementById('file-'+gal_id).files[0]);
                        form_data.append('gal_id', gal_id);
                        
                        if(confirm('Bạn muốn xóa hình ảnh này không')) {
                            $.ajax({
                            url:"{{url('/update-gallery-image')}}",
                            method: "POST",
                            headers:{
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:form_data,
                            contentType:false,
                            cache:false,
                            processData:false,
                            success:function(data) {
                               
                                var imagesdetail_id =$('.imagesdetail_id').val();
                                var _token =$('input[name="_token"]').val();
                                $.ajax({
                                    url:"{{url('/select-gallery')}}",
                                    method: "POST",
                                    data:{imagesdetail_id:imagesdetail_id,_token:_token},
                                    success:function(data) {
                                    $('#gallery_load').html(data);
                                    }
                                });
                                $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
                            }
                            });
                        }

                    });
                });

        </script> 
        <style>
            .img-thumbnail {
                display: inline-block;
                max-width: 100%;
                height: 150px;
                padding: 4px;
                line-height: 1.42857143;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 4px;
                -webkit-transition: all .2s ease-in-out;
                -o-transition: all .2s ease-in-out;
                transition: all .2s ease-in-out;
            }
        </style>

    <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Thư Viện Ảnh
                        </header>
                        <br> <br>
                        <form action = "{{url('/insert_imagesdetail/'.$imagesdetail_id)}}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="row"> 
                                <div class="col-md-3" align="right">

                                </div>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple> <!-- multiple là chọn nhiều chuỗi -->
                                    <span id="error_gallery"></span>
                                </div> 
                                <div class="col-md-3" >
                                    <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success">
                                </div>
                        </div>
                        </form>




                        <div class="panel-body">
                        
                            <input type="hidden" value = "{{$imagesdetail_id}}" name = "imagesdetail_id" class="imagesdetail_id">
                            
                            <form>
                            @csrf

                            <div id= "gallery_load">
                            

                        </div>
                        </form>
                    </div>
                    
                </section>
                               
            </div>
        
            
    </div>
    <!-- Hiển thị ảnh trong thư mục -->
    <script type="text/javascript">
    $(document).ready (function() {
        load_gallery();
        function load_gallery() {
            
            var imagesdetail_id =$('.imagesdetail_id').val();
            var _token =$('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/select-gallery')}}",
                method: "POST",
                data:{imagesdetail_id:imagesdetail_id,_token:_token},
                success:function(data) {
                $('#gallery_load').html(data);
                }
            });
        }
        
    });

    </script> 
     
     
    

    @endsection  
    
