<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Gallery;
use App\Models\Rating;

use File; // có quyền copy file ảnh tử folder này sang folder khác
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class Productcontroller extends Controller
{
    public function Authadmin() {
        $admin_id= Session::get('admin_id');
        if($admin_id) {
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
        
    }

    public function add_cate_product() {
        $this->Authadmin();
        $cate_product= DB::table('tbl_category_product')->orderby('categor_id','desc')->get();
        $discount_product= DB::table('tbl_discount')->where('status','1')->orderby('discount_id','desc')->get();
        // join là tham gia của các bảng khác
        $all_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->orderby('tbl_product.product_id','desc') ->get();
        $manager_category_product = view('admin.add_product')->with('cate_product',$cate_product)->with('discount_product',$discount_product)->with('all_product',$all_product); ;
        return view('admin.admin_layout')->with('admin.add_product',$manager_category_product);
            
    }
    public function add_product(Request $request) {
        $this->Authadmin();
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['product_desc'] = $request ->product_desc;
        $data['product_status'] = $request ->product_status;
        $data['categor_id'] = $request ->category_product;
        $data['discount_id'] = $request ->discount_product;
        $data['product_price'] = $request ->product_price;
        $data['product_image'] = $request ->product_image;
        //Thêm file ảnh vào thư mục khi mình tự chọn ảnh ngoài
        $get_image = $request ->file('product_image');

        $path='public/uploads/product/';
        $path_gallery='public/uploads/gallery/';

        if($get_image) {
            $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
            $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
            $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
            // lấy tên file ảnh hiện tại sang file ảnh khác với tên như cũs
            $get_image -> move($path, $new_image);
            file::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
            
        }//
        
         $pro_id= DB::table('tbl_product')->insertGetId($data);
         $gallery = new Gallery();
         $gallery->images_detail = $new_image;
         $gallery->product_name=$new_image;
         $gallery->id_product= $pro_id;
         $gallery->save();
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('/product');
        
    }
    public function unactive_product($product_id) {
        $this->Authadmin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('mess','Kích hoạt sản phẩm thành công');
        return Redirect::to('/product');
    }
    public function active_product($product_id) {
        $this->Authadmin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('mess','Không kích hoạt sản phẩm thành công');
        return Redirect::to('/product');
    }
    public function delete_product($product_id) {
        $this->Authadmin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('mess2','Bạn vừa xóa danh mục sản phẩm thành công');
        return Redirect::to('/product');
     }

     public function edit_product( $product_id) {
        $this->Authadmin();
        $cate_product= DB::table('tbl_category_product')->orderby('categor_id','desc')->get();
        $discount_product= DB::table('tbl_discount')->where('status','1')->orderby('discount_id','desc')->get();
        
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('discount_product',$discount_product);
        return view('admin.admin_layout')->with('admin.edit_product',$manager_product);
     }
//////////////////////////


     public function search_product_admin( Request $request) {
        $keysearch = $request-> keysearch;
       
        $search_product_admin= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->where('tbl_product.product_name','like','%'.$keysearch.'%')->get();
        $search = view('admin.search_product')->with('search_product',$search_product_admin);
        return view('admin.admin_layout')->with('admin.search_product',$search);
     }
     
///////////////////////
     public function update_product (Request $request,$product_id) {
        $this->Authadmin();
        $data = array();
        $data['product_name'] = $request ->product_name;
        $data['product_desc'] = $request ->product_desc;
        $data['discount_id'] = $request ->discount_product;
        // $data['product_status'] = $request ->product_status;
        $data['categor_id'] = $request ->category_product;
        $data['product_price'] = $request ->product_price;
        

        $get_image = $request ->file('product_image');
        if($get_image) {
            $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
            $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
            $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
            $get_image -> move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('mess2','Đã sửa sản phẩm thành công');
            return Redirect::to('/product');
        }//
        
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('mess2','Đã sửa sản phẩm thành công');
        return Redirect::to('/product');
     }

    //chi tiết sản phẩm
    public function product_details(Request $request,$product_id) {
        $result = DB::table('tbl_cart')->where('tbl_cart.status',1)->first();
           if($result) {
            Cart::destroy();
            DB::table('tbl_cart')->delete();
           }else {
            DB::table('tbl_cart')->delete();
           }
        $cate_product= DB::table('tbl_category_product')->where('categor_status','1')->orderby('categor_id','desc')->get();
        $details_product= DB::table('tbl_product')
        ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->where('tbl_product.product_id',$product_id)->get();
         foreach($details_product as $key => $det_pro) {
            $categor_id = $det_pro -> categor_id;
            
        }
         
        foreach($details_product as $key => $val) {
            $product_id =$val->product_id;
            $meta_desc = $val->categor_desc;
            $meta_keywords = $val->meta_keywords;
            $meta_title=$val->product_name;
            $url_canonical = $request->url();
           }
         //gallery
         $gallery_productsdetail= Gallery::where('id_product',$product_id)->get();
        
         $image_detail_product = DB::table('tbl_product')
         ->join('tbl_imagesdetail','tbl_imagesdetail.id_product','=','tbl_product.product_id')->where('tbl_imagesdetail.id_product',$product_id)->orderby('tbl_imagesdetail.id_product','desc')->limit(4)->get();

         $related_products = DB::table('tbl_product')
         ->join('tbl_discount','tbl_discount.discount_id','=','tbl_product.discount_id')
        ->join('tbl_category_product','tbl_category_product.categor_id','=','tbl_product.categor_id')->where('tbl_category_product.categor_id',$categor_id)->where('product_status','1')->whereNotIn('tbl_product.product_id',[$product_id])->get();
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id',$customer_id)->get();
        $rating_review = Rating::where('product_id',$product_id)->join('tbl_customer','tbl_customer.customer_id','=','tbl_rating.customer_id')->get();

        return view('pages.product_details')->with('category',$cate_product)->with('details_product', $details_product)->with('related_products',$related_products)->with('image_detail_product',$image_detail_product)
        ->with('meta_desc',$meta_desc)->with('meta_title',$meta_title)->with('meta_keywords',$meta_keywords)->with('url_canonical', $url_canonical)->with('gallery_productsdetail',$gallery_productsdetail)
        ->with('rating',$rating)->with('customer',$customer)->with('rating_review',$rating_review);
    }
    // public function save_cmmt(Request $request, $product_id) {
    //     $data=array();
    //     $product_rat = $product_id;
    //     $customer_rat = Session::get('customer_id');
    //     $rating = Session::get('rating'); 
    //     if($rating) {
    //     $data['comments'] = $request->cmmt_rating;
    //     $rating_id= DB::table('tbl_rating')->where('product_id',$product_rat)->where('customer_id',$customer_rat)->where('rating',$rating)->update($data);
    //     Session::put('rating_id',$rating_id);
    //     return view('pages.product_details');
    //     }
    //     else{
    //     $data['rating'] = 5;
    //     $data['comments'] = $request->cmmt_rating;
    //     $rating_id= DB::table('tbl_rating')->where('product_id',$product_rat)->where('customer_id',$customer_rat)->update($data);
    //     Session::put('rating_id',$rating_id);
    //     return view('pages.product_details');
    //     }
        
        
    // }
    public function review_rating (Request $request) {
            $data= $request->all();
            $rating = new Rating();
            $rating-> product_id = $data['id_product'];
            $rating-> customer_id = $data['id_customer'];
            $rating-> rating = $data['data_rating'];
            $rating-> comments = $data['user_review'];
            $rating->save();
        
        
    }

    



   //// // Ảnh chi tiết
    public function imagesdetail( $product_id) {
        $this->Authadmin();
        $imagesdetail_id = $product_id;
        return view('admin.imagesDetail')-> with(compact('imagesdetail_id'));
     }
     public function select_gallery(Request $request) {
    
        $this->Authadmin();
        $id_product = $request->imagesdetail_id;
        $gallery = Gallery::where('id_product',$id_product)->get();
        $gallery_count = $gallery->count();
        $outputgallery ='
                        <form>
                        '.csrf_field().'
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th> Thứ tự</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình sản phẩm chi tiết </th>
                                    <th>Quản lý</th>
                                </tr>
                                </thead>
                                <tbody>

        ';
        if($gallery_count>0) {
            $i =0;
            foreach($gallery as $key => $gal) {
                $i++;
                $outputgallery.='
                                
                                <tr>
                                    <td>'.$i.'</td>
                                    <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->id.'">'.$gal->product_name.'</td>
                                    <td> <img src="'.url('public/uploads/gallery/'.$gal->images_detail).'" class="img-thumbnail" width="120" heigth="120">
                                    <input type="file" class="file_image" style="width:40%" data-gal_id="'.$gal->id.'" id="file-'.$gal->id.'"> 
                                    </td>
                                    <td>
                                        <button type="button" data-gal_id="'.$gal->id.'" class="btn btn-xs btn-danger delete-gallery">Xóa</button>
                                    </td>
                                </tr>
                                
                ';
            }
        }else {
            $outputgallery.='
                        <tr>
                            <td colspan ="4">Sản Phẩm chưa thư viện ảnh</td>
                            
                        </tr>
            ';
        }
        $outputgallery.='
                        </tbody>
                        </table>
                        </form>
        ';
        echo $outputgallery;
    }

    public function  insert_imagesdetail(Request $request, $imagesdetail_id) {
        $get_image = $request->file('file');
        if($get_image) {
            foreach($get_image as $image) {
                $get_name_image = $image ->getClientOriginalName();// Lấy tên file ảnh
                $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
                $new_image = $name_image.rand(0,99).'.'.$image ->getClientOriginalExtension();
                $image -> move('public/uploads/gallery',$new_image);
                $gallery= new Gallery();
                $gallery->product_name = $new_image;
                $gallery->images_detail = $new_image;
                $gallery->id_product= $imagesdetail_id;
                $gallery->save();
            }
        }
        // Session::put('message','Thêm thư viện ảnh thành công');
        return redirect()->back();
    }
    public function update_gallery_name(Request $request) {
            $gal_id = $request->gal_id;
            $gal_text = $request->gal_text;
            $gallery= Gallery::find($gal_id);
            $gallery->product_name = $gal_text;
            $gallery->save();
    }
    public function delete_gallery_name (Request $request) {
        $gal_id = $request->gal_id;
        $gallery= Gallery::find($gal_id);
        unlink('public/uploads/gallery/'.$gallery->images_detail);
        $gallery->delete();
    }
    public function update_gallery_image(Request $request) {
        $get_image = $request->file('file');
        $gal_id = $request->gal_id;
        if($get_image) {
                $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
                $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
                $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
                $get_image -> move('public/uploads/gallery',$new_image);
                
                $gallery= Gallery::find($gal_id);
                unlink('public/uploads/gallery/'.$gallery->images_detail);
                $gallery->images_detail = $new_image;
                $gallery->save();
            
        }
    }
    //// DISCOUNT
    public function discount() {
        $this->Authadmin();
        $cate_product_discount= DB::table('tbl_category_product')->orderby('categor_id','desc')->get();
        
        $all_discount= DB::table('tbl_discount')->orderby('tbl_discount.discount_id','desc') ->get();
        $category_discount= view('admin.discount')->with('cate_product',$cate_product_discount)->with('all_discount',$all_discount);
        return view('admin.admin_layout')->with('admin.discount',$category_discount);
            
    }
    public function save_discount(Request $request) {
        $this->Authadmin();
        $data_discount = array();
        $data_discount['discount_name'] = $request ->discount_name;
        $data_discount['discount_percent'] = $request ->discount_percent;
        $data_discount['discount_image'] = $request ->discount_image;
        $data_discount['discount_object'] = $request ->discount_object;
        $data_discount['status'] = $request ->discount_status;

        $get_image_discount = $request ->file('discount_freeship');
        if($get_image) {
            $get_name_image = $get_image_discount ->getClientOriginalName();// Lấy tên file ảnh
            $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
            $new_image = $name_image.rand(0,99).'.'.$get_image_discount ->getClientOriginalExtension();
            $get_image_discount -> move('public/uploads/discount',$new_image);
            $data_discount['discount_image'] = $new_image;
            DB::table('tbl_discount')->insert($data_discount);
            Session::put('message','Thêm danh mục discount thành công');
            return Redirect::to('/discount');
        }//
        $data_discount['discount_image'] = '';
        DB::table('tbl_discount')->insert($data_discount);
        Session::put('message','Thêm danh mục discount thành công');
        return Redirect::to('/discount');
        
    }
    public function unactive_discount($discount_id) {
        $this->Authadmin();
        DB::table('tbl_discount')->where('discount_id',$discount_id)->update(['status'=>1]);
        Session::put('mess','Kích hoạt sản phẩm thành công');
        return Redirect::to('/discount');
    }
    public function active_discount($discount_id) {
        $this->Authadmin();
        DB::table('tbl_discount')->where('discount_id',$discount_id)->update(['status'=>0]);
        Session::put('mess','Không kích hoạt sản phẩm thành công');
        return Redirect::to('/discount');
    }
    public function delete_discount($discount_id) {
        $this->Authadmin();
        DB::table('tbl_discount')->where('discount_id',$discount_id)->delete();
        Session::put('mess2','Bạn vừa xóa danh mục sản phẩm thành công');
        return Redirect::to('/discount');
     }

     public function edit_discount( $discount_id) {
        $this->Authadmin();
        $cate_discount= DB::table('tbl_category_product')->orderby('categor_id','desc')->get();
        
        $edit_discount = DB::table('tbl_discount')->where('discount_id',$discount_id)->get();
        $manager_discount = view('admin.edit_discount')->with('edit_discount',$edit_discount)->with('cate_discount',$cate_discount);
        return view('admin.admin_layout')->with('admin.edit_discount',$manager_discount);
     }
     public function update_discount(Request $request, $discount_id) {
        $this->Authadmin();
        $data_discount_update = array();
        $data_discount_update['discount_name'] = $request ->discount_name;
        $data_discount_update['discount_percent'] = $request ->discount_percent;
        $data_discount_update['discount_object'] = $request ->discount_object;
        $get_image = $request ->file('edit_discount_image');
        if($get_image) {
            $get_name_image = $get_image ->getClientOriginalName();// Lấy tên file ảnh
            $name_image = current(explode('.',$get_name_image)); // current sẽ bỏ phần đuôi ảnh từ dấu chấm(.)
            $new_image = $name_image.rand(0,99).'.'.$get_image ->getClientOriginalExtension();
            $get_image -> move('public/uploads/discount',$new_image);
            $data_discount_update['discount_image'] = $new_image;
            DB::table('tbl_discount')->where('discount_id',$discount_id)->update($data_discount_update);
            Session::put('mess2','Đã sửa danh mục dícount thành công');
            return Redirect::to('/discount');
        }//
        
        DB::table('tbl_discount')->where('discount_id',$discount_id)->update($data_discount_update);
        Session::put('mess2','ĐĐã sửa danh mục dícount thành công');
        return Redirect::to('/discount');
        
    }
}    