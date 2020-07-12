<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Cart;

use Hash;
use App\Order;
use App\OrderDetail;
use App\Product;
use App\ProductType;
use App\ProductCategory;
use App\Openshop;
use App\User;
use App\Contact;
use App\CommentRate;

class ClientController extends Controller
{
	//pages
    public function get_index_page()
    {
       
        $selling = Product::select('id','slug','name','price','promotional','rate','image')->where('status',1)->limit(8)->where('hot',0)->orderBy('id','DESC')->get();
        $sale = Product::select('id','slug','name','price','promotional','rate','image')->where('status',1)->limit(8)->where('promotional','!=',0)->orderBy('id','DESC')->get();
        $new = Product::select('id','slug','name','price','promotional','rate','image')->where('status',1)->limit(8)->where('new',1)->orderBy('id','DESC')->get();

    	return view('pagesF.index',compact('selling','sale','new'));
    }

    public function get_product_page()
    {
        $products = Product::select('slug','name','price','promotional','image','rate')->where('status',1)->paginate(16);
        $types = ProductType::select('id','slug','name')->get();
        $cats = ProductCategory::select('id','name','slug')->get();
    	return view('pagesF.product',compact('products','types','cats'));
    }

    public function get_categoryproduct_page($slug)
    {
        $products = Product::select('producs.slug','producs.name','price','promotional','image','rate')->join('product_category','product_category.id','=','producs.id_category')->where('product_category.slug',$slug)->where('status',1)->paginate(16);
        $types = ProductType::select('id','slug','name')->get();
        $cats = ProductCategory::select('id','name','slug')->get();
        return view('pagesF.product',compact('products','types','cats'));
    }

    public function get_searchallproduct_page(Request $request)
    {
        $cat = $request->selectcategory;
        $type = $request->selecttype;
        $sort = $request->selectsortby;
        $price = $request->selectprice;
        if( $sort == 1 || $sort == 2  )
        {
            $sortby = 'price';
        }
        elseif( $sort == 3 || $sort == 4 )
        {
            $sortby = 'name';
        }
        else
            $sortby = 'id';

        if( $sort == 0 || $sort == 1 || $sort == 3 )
        {
            $orderby = 'ASC';
        }
        else
        {
            $orderby = 'DESC';
        }
        if( $cat == 0 )
        {
            if( $type == 0 )
            {
                $products = Product::select('slug','name','price','promotional','image','rate')->where('status',1)->where('name','like','%'.$request->key.'%')->orderBy($sortby,$orderby)->paginate(16);
            }
            else
            {
                $products = Product::select('slug','name','price','promotional','image','rate')->where('status',1)->where('name','like','%'.$request->key.'%')->where('id_type',$type)->orderBy($sortby,$orderby)->paginate(16);
            }
        }
        else
        {
            if( $type == 0 )
            {
                $products = Product::select('slug','name','price','promotional','image','rate')->where('status',1)->where('name','like','%'.$request->key.'%')->where('id_category',$cat)->orderBy($sortby,$orderby)->paginate(16);
            }
            else
            {
                $products = Product::select('slug','name','price','promotional','image','rate')->where('status',1)->where('name','like','%'.$request->key.'%')->where('id_category',$cat)->where('id_type',$type)->orderBy($sortby,$orderby)->paginate(16);
            }
        }
        
        $types = ProductType::select('id','slug','name')->get();
        $cats = ProductCategory::select('id','name','slug')->get();
        return view('pagesF.product',compact('products','types','cats'));
    }

    public function post_selecttypessearch(Request $request)
    {
        $types = ProductType::select('id','name')->where('id_category',$request->idcat)->get();
        return response()->json(['types'=>$types]);
    }

    public function get_typeproduct_page($slug)
    {
        $products = Product::select('producs.slug','producs.name','price','promotional','image','rate')->join('product_type','product_type.id','=','producs.id_type')->where('product_type.slug',$slug)->where('status',1)->paginate(16);
        $types = ProductType::select('id','slug','name')->get();
        $cats = ProductCategory::select('id','name','slug')->get();

        return view('pagesF.product',compact('products','types','cats'));
    }

    public function get_vendor_page($slug)
    {
        $vendor = User::select('avatar_shop','name_shop','phone_shop','address_shop','mail_shop','fanpage_facebook')->where('status_shop',1)->where('id',$slug)->where('status',1)->first();

        if( $vendor == null )
        {
            return redirect('/');
        }
        $ours = Product::select('id','slug','name','price','promotional','rate','image')->where('status',1)->limit(8)->where('hot',0)->orderBy('id','DESC')->where('id_vendor',$slug)->get();

        $ours_sale = Product::select('id','slug','name','price','promotional','rate','image')->where('status',1)->limit(8)->where('promotional','!=',0)->orderBy('id','DESC')->where('id_vendor',$slug)->get();

        $ours_new = Product::select('id','slug','name','price','promotional','rate','image')->where('status',1)->limit(8)->where('new',1)->orderBy('id','DESC')->where('id_vendor',$slug)->get();

        return view('pagesF.vendor',compact('ours','ours_sale','ours_new','vendor'));
    }

    public function get_detailproduct_page($slug)
    {
        $detail_product = Product::where('producs.slug',$slug)->select('product_category.slug as slugcat','id_type','product_category.name as namecat','producs.id','producs.slug','producs.name','price','promotional','image','description','content','id_vendor','quantity')->join('product_category','product_category.id','=','producs.id_category')->first();

        $listimgdb = Product::where('slug',$slug)->select('list_image')->first();
        $listsizedb = Product::where('slug',$slug)->select('size')->first();
        $listcolordb = Product::where('slug',$slug)->select('color')->first();
        $relateproduct = Product::whereNotIn('slug',[$slug])->select('slug','name','image','price','promotional')->where('id_type',$detail_product->id_type)->take(8)->get();

        $listimg = explode("?", $listimgdb['list_image']);
        // dd($listimg[0]);

        $listsize = explode("?", $listsizedb['size']);

        $listcolor = explode("?", $listcolordb['color']);

        $countcmt = CommentRate::select('users.avatar','users.name','comment_rate.content','comment_rate.created_at','comment_rate.rate')->join('producs','producs.id','=','comment_rate.id_product')->join('users','users.id','=','comment_rate.id_user')->get();

        $total_rate = CommentRate::select(\DB::raw('sum(3) as totalrate'))->join('producs','producs.id','=','comment_rate.id_product')->where('producs.slug',$slug)->get();

        $infoshop = Product::where('slug',$slug)->join('users','users.id','=','producs.id_vendor')->select('users.avatar_shop','users.name_shop','users.phone_shop','users.address_shop','users.mail_shop','users.id')->get();
        

        if( $total_rate[0]->totalrate == null )
        {
            $avg_rate = 0;
        }
        else if( $total_rate[0]->totalrate != null )
        {
            $avg_rate = $total_rate[0]->totalrate / count($countcmt);
        }
        
        if( Auth::check() )
        {
            $check_comment = OrderDetail::where('producs.slug',$slug)->join('producs','order_detail.id_product','=','producs.id')->where('order_detail.id_user',Auth::user()->id)->count();

            $check_cmt_user = CommentRate::select('comment_rate.check_cmt')->where('id_user',Auth::user()->id)->join('producs','producs.id','=','comment_rate.id_product')->where('producs.slug',$slug)->get();

            return view('pagesF.detailproduct',compact('detail_product','listimg','listsize','listcolor','relateproduct','countcmt','avg_rate','check_cmt_user','check_comment','infoshop'));
        }
        else
        {
            return view('pagesF.detailproduct',compact('detail_product','listimg','listsize','listcolor','relateproduct','countcmt','avg_rate','infoshop'));
        }
    	
    }

    public function get_cart_page()
    {   
        return view('pagesF.cart');
    }



    public function post_addcart_function(Request $request)
    {
        Cart::add([
            'id'            => $request->idproduct,
            'name'          => $request->nameproduct,
            'qty'      => $request->quantity,
            'price'         => $request->price,
            'weight'        => 1,
            'options'    => [
                'size'      => $request->size,
                'color'     => $request->color,
                'idvendor'  => $request->idvendor,
                'image'     => $request->image
            ]
        ]);

        $countcart = Cart::count();

        return response()->json(['count'=>$countcart]);
    }


    public function post_updatecart_function(Request $request)
    {

        $rowId = $request->rowId;
        
        
        if( $request->quantityproduct == 0 )
        {
            
            $remove = true;
            Cart::remove($rowId);
            $countcart = Cart::count();
            $totalprice = Cart::subtotal(); 
            return response()->json(['count'=>$countcart,'removeItem'=>$remove,'totalprice'=>$totalprice]);
        }
        else
        {
            Cart::update($rowId, ['qty'=>$request->quantityproduct]);
        }
        $priceproduct = Cart::get($rowId)->price*Cart::get($rowId)->qty;
        $totalprice = Cart::subtotal(); 
        $countcart = Cart::count();
        return response()->json(['count'=>$countcart,'priceproduct'=>$priceproduct,'totalprice'=>$totalprice]);
    }



    public function post_postcomment_page(Request $request)
    {

        $file = strlen($request->fi);
        $new_comment = new CommentRate;
        $new_comment->id_product = $request->id_product;
        $new_comment->rate = $request->rate;
        $new_comment->content = $request->content;
        $new_comment->id_user = Auth::user()->id;
        $new_comment->save();

        $count = CommentRate::where('id_product',$request->id_product)->count();
        return response()->json(['success'=>'success','count'=>$count]);
    }


    public function get_clearcart_function()
    {
        Cart::destroy();
        return redirect()->back();
    }

    public function get_login_page()
    {
        if( Auth::check() )
        {
            return redirect('/');
        }
        else
        {
            return view('pagesF.login');
        }
        
    }

    public function get_logout()
    {
        if( Auth::check() )
        {
            Auth::logout();
            Cart::destroy();
            $goodbye = "Thank you choose website to shopping !";
            return redirect('/')->with('goodbye',$goodbye);
        }
        else
        {
            return view('pagesF.login');
        }
       
    }

    public function get_contact_page()
    {
        return view('pagesF.contact');
    }

    public function get_suggestopenshop()
    {
        return view('pagesF.waitrelpy');
    }

    public function post_contact_page( Request $request )
    {
        $request->validate(
            [
                'name'  => 'min:2|max:30',
                'msg'   => 'min:20|max:150',
            ]
        );
        
        $letter = new Contact();
        $letter->name = $request->name;
        $letter->mail = $request->email;
        $letter->message = $request->msg;
        $letter->save();

        return redirect()->back()->with('thanks','Thank You Contact US');
    }

    public function get_about_page()
    {
        return view('pagesF.about');
    }

    public function post_order_function(Request $request)
    {
        if( Auth::check() )
        {
            $iduser = Auth::user()->id;
        }
        else
        {
            $iduser = 0;
        }
        $countorder = Order::count();
        $countorder++;
        $address = $request->address;
        $name = $request->name;
        $mail = $request->mail;
        $phone = $request->phone;
        $letter = $request->message;
        $total_money = Cart::subtotal();
        $total_quantity = Cart::count();

        $neworder = new Order;
        $neworder->id_user      = $iduser;
        $neworder->code_order = '#COZA-'.$iduser.$countorder.rand(1,9999);
        $neworder->address      = $address;
        $neworder->name_recipient      = $name;
        $neworder->email      = $mail;
        $neworder->phone      = $phone;
        $neworder->letter      = $letter;
        $neworder->total_money      = $total_money;
        $neworder->total_quantity      = $total_quantity;
        $neworder->save();
        foreach ( Cart::content() as $item)
        {
            $product = Product::find($item->id);
            $product->quantity = $product->quantity - $item->qty;
            $product->save();
            $neworderdetail = new OrderDetail;
            $neworderdetail->id_user = $iduser;
            $neworderdetail->id_order = $neworder->id;
            $neworderdetail->id_product = $item->id;
            $neworderdetail->id_vendor = $item->options->idvendor;
            $neworderdetail->money = $item->price;
            $neworderdetail->quantity = $item->qty;
            $neworderdetail->size = $item->options->size;
            $neworderdetail->color = $item->options->color;
            $neworderdetail->save();
        }
        Cart::destroy();
        return redirect()->back()->with('success','Order Success');
        
    }

    public function post_checklogin_page(Request $request)
    {
        $username = $request['mail'];
        $password = $request['pass'];

        if( Auth::attempt(['email'=>$username,'password'=>$password,'rule'=>0,'status'=>1]) )
        {
            $exactly = "Logged in successfully !";
            return redirect('/')->with('exactly',$exactly);
        }
        else
        {
            $error = "The account or password is incorrect!";
            return view('pagesF.login',compact('error'));
        }
    }







    //customer
    public function get_infocustomer_page()
    {
        if( Auth::check() )
        {
            return view('pagesF.profiled');
        }
        else
        {
            return redirect('/login');
        }
    }

    public function get_ordercustomer_page()
    {
        if( Auth::check() )
        {
            $orders = Order::select('order.status','order.status_order','order.address','order.name_recipient','order.email','order.phone','order.letter','order.total_money','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color','producs.image','producs.name')->join('order_detail','order_detail.id_order','=','order.id')->where('order.id_user',Auth::user()->id )->join('producs','producs.id','=','order_detail.id_product')->get();
            return view('pagesF.myorder',compact('orders'));
        }
        else
            return redirect('/login');
    }

    public function post_changepassword_function(Request $request)
    {
        $current_pass = $request->password;
        $newpassword = $request->newpassword;
        $confirm_password = $request->confirm_password;

        if( Hash::check($current_pass,Auth::user()->password) )
        {
            if( $current_pass == $newpassword )
            {
                $error = "1";
                return redirect()->back()->with('error',$error);
            }
            else
            {
                $user = User::find( Auth::user()->id );
                $user->password = bcrypt($newpassword);
                $user->save();
                $success = "2";    
                return redirect()->back()->with('success',$success);
            }
        }
        else
        {
            $error2 = "1";
            return redirect()->back()->with('error2',$error2);
        }

    }

    public function post_signin(Request $request)
    {
        $request->validate(
            [
                'email' => 'unique:users',
                'password'  => ['required', 
                                'min:8', 
                                'regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/'],
                'confirmpassword'   => 'same:password',
                'phone' => 'min:9|max:15',
            ],
        );

        $name = $request->name;
        $phone = $request->phone;
        $email = $request->email;
        $address = $request->address;
        $password = $request->password;
        $confirmpassword = $request->confirmpassword;

        $user = new User();
        $user->name = $name;
        $user->phone = $phone;
        $user->email = $email;
        $user->address = $address;
        $user->status = 1;
        $user->password = bcrypt($password);

        $user->save();

        // Cart::destroy();
        return redirect()->back()->with('success','Signin new account success !');
    }





    //vendor
    public function get_dashboardvendor_page()
    {
        $products = Product::where('id_vendor',Auth::user()->id)->count();
        $orders = OrderDetail::where('id_vendor',Auth::user()->id)->count();
        $revenue = OrderDetail::select(\DB::raw('sum(quantity*money) as totalprice'))->where('id_vendor',Auth::user()->id)->get();

        $months =  OrderDetail::select(\DB::raw('MONTHNAME(created_at) as Month'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->where('id_vendor',Auth::user()->id)->get();
        $arr_month = array();
        foreach ($months as $key => $value) 
        {
            array_push($arr_month, $value['Month']);
        }

        $sumrevenue =  OrderDetail::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('sum(quantity*money) as sum_money'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->where('id_vendor',Auth::user()->id)->get();

        $arr_revenue = array();
        foreach ($sumrevenue as $key => $value) 
        {
            array_push($arr_revenue, $value['sum_money']*0.9);
        }

        $sum_order =  OrderDetail::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('sum(quantity) as quantity'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->where('id_vendor',Auth::user()->id)->get();
        $arr_order = array();
        foreach ($sum_order as $key => $value) 
        {
            array_push($arr_order, $value['quantity']);
        }

        $arr_totalprice = array();
        foreach ($sumrevenue as $key => $value) 
        {
            array_push($arr_totalprice, $value['sum_money']);
        }

        $detail_order = OrderDetail::select('order_detail.cancel','order_detail.status','order_detail.quantity','order_detail.id','order_detail.size','order_detail.color','producs.name','order.name_recipient','users.avatar')->join('producs','producs.id','=','order_detail.id_product')->join('order','order.id','=','order_detail.id_order')->join('users','users.id','=','order.id_user')->where('order_detail.id_vendor',Auth::user()->id)->get()->take(5);
        return view('pagesF.vendor.dashboard',compact('products','orders','revenue','arr_month','arr_revenue','arr_order','arr_totalprice','detail_order'));
    }

    public function get_newvendor_function()
    {
        if( Auth::user()->status_shop == 0 )
        {
            return view('pagesF.newsuggestvendor');
        }
        else
            return redirect('/');
        
    }

    public function post_opennewvendor_function(Request $request)
    {
        if( Auth::check() )
        {
            $nameshop = $request->shopname;
            $address_shop = $request->addressshop;
            $phone_shop = $request->phoneshop;
            $mail_shop = $request->emailshop;
            $fanpage_facebook = $request->fanpge;
            $account = $request->account;
            $letter = $request->letter;

            $update_vendor = User::find( Auth::user()->id );
            $update_vendor->name_shop = $nameshop;
            $update_vendor->address_shop = $address_shop;
            $update_vendor->pending = 1;
            $update_vendor->phone_shop = $phone_shop;
            $update_vendor->mail_shop = $mail_shop;
            $update_vendor->fanpage_facebook = $fanpage_facebook;

            if( $request->hasFile('imgavatar') )
            {
                $file = $request->file('imgavatar');
                $filedetail = $file->getClientOriginalExtension('imgavatar');

                if( $filedetail == "jpg" || $filedetail == "png" || $filedetail == "jpeg" )
                {
                    $file->move('public/assetF/images/avatar',Auth::user()->id."shop.".$filedetail);
                    $update_vendor->avatar_shop = Auth::user()->id."shop.".$filedetail;
                    $update_vendor->save();

                    $newletter = new Openshop;
                    $newletter->id_user = Auth::user()->id;
                    $newletter->letter = $letter;
                    $newletter->save();
                    
                    $success = 'Suggest Open New Shop Success ! Wait Letter For Us !';
                    return redirect()->back()->with('success',$success);
                }
                else
                {
                    $error = 'Updated Error . Type File Must Be Image !!!';
                    return redirect()->back()->with('error',$error);
                }
            }
            else
            {
                $error_img = 'Please Choose Image Vendor';
                return redirect()->back()->with('error_img',$error_img);
            }
                
        }
        else
        {
            return redirect('/login');
        }
    }

    public function get_infovendor_page()
    {
        return view('pagesF.vendor.profilemyshop');
    }

    public function post_updatedinfoshopvendor(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $address = $request->address;
        $fanpage = $request->fanpage;
        $mail = $request->mail;

        $update_user = User::find( Auth::user()->id );
        $update_user->name_shop = $name;
        $update_user->address_shop = $address;
        $update_user->fanpage_facebook = $fanpage;
        $update_user->phone_shop = $phone;
        $update_user->mail_shop = $mail;

        if( $request->hasFile('imgavatar') )
        {
            $file = $request->file('imgavatar');
            $filedetail = $file->getClientOriginalExtension('imgavatar');

            if( $filedetail == "jpg" || $filedetail == "png" || $filedetail == "jpeg" )
            {
                $file->move('public/assetF/images/avatar',Auth::user()->id."shop.".$filedetail);
                $update_user->avatar_shop = Auth::user()->id."shop.".$filedetail;
                $update_user->save();
                $success = 'Updated Success';
                return redirect()->back()->with('success',$success);
            }
            else
            {
                $error = 'Updated Error';
                return redirect()->back()->with('error',$error);
            }
        }
        else
        {
            $update_user->save();
            $success = 'Updated Success';
            return redirect()->back()->with('success',$success);
        }
    }

    public function get_ordervendor_page()
    {
        $orders = OrderDetail::select('order_detail.cancel','order_detail.status','order_detail.id','code_order','address','name_recipient','email','phone','letter','order.created_at','image','name','id_order','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color')->join('producs','producs.id','=','order_detail.id_product')->join('order','order.id','=','order_detail.id_order')->where('order_detail.id_vendor',Auth::user()->id)->where('order_detail.status',0)->where('order_detail.cancel',0)->get();
        $name = 'Order Wait Product';
        return view('pagesF.vendor.managerorder',compact('name','orders'));
    } 

    public function get_myorderconfirm_page()
    {
        $orders = OrderDetail::select('order_detail.cancel','order_detail.status','order_detail.id','code_order','address','name_recipient','email','phone','letter','order.created_at','image','name','id_order','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color')->join('producs','producs.id','=','order_detail.id_product')->join('order','order.id','=','order_detail.id_order')->where('order_detail.id_vendor',Auth::user()->id)->where('order_detail.status',1)->where('order_detail.cancel',0)->get();
        $name = 'Order Confirm';
        return view('pagesF.vendor.managerorder',compact('name','orders'));
    }

    public function get_cancelordervendor_page()
    {
        $orders = OrderDetail::select('order_detail.cancel','order_detail.status','order_detail.id','code_order','address','name_recipient','email','phone','letter','order.created_at','image','name','id_order','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color')->join('producs','producs.id','=','order_detail.id_product')->join('order','order.id','=','order_detail.id_order')->where('order_detail.id_vendor',Auth::user()->id)->where('order_detail.status',0)->where('order_detail.cancel',1)->get();
        $name = 'Order Cancel';
        return view('pagesF.vendor.managerorder',compact('name','orders'));
    }

    public function get_ordercompleted_page()
    {
        $orders = OrderDetail::select('order_detail.cancel','order_detail.status','order_detail.id','code_order','address','name_recipient','email','phone','letter','order.created_at','image','name','id_order','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color')->join('producs','producs.id','=','order_detail.id_product')->join('order','order.id','=','order_detail.id_order')->where('order.status',2)->where('status_order',1)->where('order_detail.id_vendor',Auth::user()->id)->where('order_detail.status',1)->where('order_detail.cancel',0)->get();
        $name = 'Order Completed';
        return view('pagesF.vendor.managerorder',compact('name','orders'));
    }

    public function post_confirmorder_json(Request $request)
    {
        $id_dt_order = $request->id_dt_order;
        $order = OrderDetail::find($id_dt_order);
        $order->status = 1;
        $order->save();
        $count = OrderDetail::where('id_vendor',Auth::user()->id)->where('status',0)->where('cancel',0)->count();
        return response()->json(['count'=>$count]);
    }

    public function post_cancelorder_json(Request $request)
    {
        $id_dt_order = $request->id_dt_order;
        $order = OrderDetail::find($id_dt_order);
        $order->cancel = 1;
        $order->status = 0;
        $order->save();
        $count = OrderDetail::where('id_vendor',Auth::user()->id)->where('status',1)->where('cancel',0)->count();
        return response()->json(['count'=>$count]);
    }

    public function get_vendorsearchorder_page(Request $request)
    {
        $orders = OrderDetail::select('order_detail.status','order_detail.cancel','order_detail.id','code_order','address','name_recipient','email','phone','letter','order.created_at','image','name','id_order','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color')->join('producs','producs.id','=','order_detail.id_product')->join('order','order.id','=','order_detail.id_order')->where('order_detail.id_vendor',Auth::user()->id)->where('order_detail.id','like','%'.$request->codeorder.'%')->where('order_detail.status',0)->get();
        $name = 'Order Wait Product';
        $search = true;
        return view('pagesF.vendor.managerorder',compact('name','orders','search'));
    }

    public function get_productvendor_page()
    {
        $iduser = Auth::user()->id;
        $products = Product::select('id','slug','name','image','quantity','rate','id_category','price','promotional','id_type')->where([['id_vendor',$iduser],['status',1]])->get();
        return view('pagesF.vendor.myproduct',compact('products'));
    }

    public function get_addnewproduct_page()
    {
        $cats = ProductCategory::select('id','name','slug')->get();
        $types = ProductType::select('id','name','slug','id_category')->get();
        return view('pagesF.vendor.adnewproduct',compact('cats','types'));
    }

    public function post_selecttypes_page(Request $request)
    {
        $types = ProductType::select('name','id')->where('id_category',$request->idcat)->get();
        return response()->json(['types'=>$types]);
    }

    public function get_updatemyproductvendor_page($slug)
    {
        $detail_product = Product::where('slug',$slug)->where('id_vendor',Auth::user()->id )->select('id','name','price','promotional','image','description','content','quantity','id_type','id_category')->first();
        $cats = ProductCategory::select('name','id')->get();
        $types = ProductType::select('name','id')->where('id_category',$detail_product->id_category)->get();
        return view('pagesF.vendor.detailproduct',compact('detail_product','cats','types'));
    }

    public function post_updatedetailproductvendor(Request $request)
    {
        $name = $request->name;
        $content = $request->content;
        $description = $request->description;
        $quantity = $request->quantity;
        $price_cost = $request->price_cost;
        $price_promotional = $request->price_promotional;
        if( $price_promotional  == null)
        {
            $price_promotional = 0;
        }
        $categoryproduct = $request->categoryproduct;
        $typeproduct = $request->typeproduct;
        $id_product = $request->id_product;

        $update_product = Product::find($id_product);
        
        $update_product->name = $name;
        $update_product->content = $content;
        $update_product->description = $description;
        $update_product->quantity = $quantity;
        $update_product->price = $price_cost;
        $update_product->promotional = $price_promotional;
        $update_product->id_type = $typeproduct;
        $update_product->id_category = $categoryproduct;

        if( $request->hasFile('imgavatar') )
        {
            $file = $request->file('imgavatar');
            $filedetail = $file->getClientOriginalExtension('imgavatar');

            if( $filedetail == "jpg" || $filedetail == "png" || $filedetail == "jpeg" )
            {
                $file->move('public/assetF/images',$id_product."product.".$filedetail);
                $update_product->image = $id_product."product.".$filedetail;
                $update_product->save();
                $success = 'Updated Success';
                return redirect('/vendor/myproductvendor')->with('success',$success);
            }
            else
            {
                $error = 'Updated Error';
                return redirect('')->back()->with('error',$error);
            }
        }
        else
        {
            $update_product->save();
            $success = 'Updated Success';
            return redirect('/vendor/myproductvendor')->with('success',$success);
        }
    }

    public function post_insertnewproduct_page(Request $request)
    {
        $name = $request->name;
        $content = $request->content;
        $description = $request->description;
        $quantity = $request->quantity;
        $price_cost = $request->price_cost;
        if( $request->checkpromotional == 'false' )
        {
            $price_promotional = 0;
        }
        else
        {
            $price_promotional = $request->price_promotional;
        }

        $typeproduct = $request->typeproduct;
        $categoryproduct = $request->categoryproduct;


        $sizeproduct = $request->sizeproduct;
        $sizeproduct = implode("?",$sizeproduct);
        $colorproduct = $request->colorproduct;
        $colorproduct = implode("?",$colorproduct);
        


        $newproduct = new Product;

        $newproduct->name = $name;

        $slug = trim(mb_strtolower($name));
        $slug = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $slug);
        $slug = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $slug);
        $slug = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $slug);
        $slug = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $slug);
        $slug = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $slug);
        $slug = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $slug);
        $slug = preg_replace('/(đ)/', 'd', $slug);
        $slug = preg_replace('/[^a-z0-9-\s]/', '', $slug);
        $slug = preg_replace('/([\s]+)/', '-', $slug);

        $quan = Product::where('id_vendor',Auth::user()->id)->count();
        $total_quan = Product::count();
        $total_quan++;
        if( $quan == null )
        {
            $quan == 0;
        }
        $quan = $quan+2;
        $slug = $slug.'-'.Auth::user()->id.'-COZA-'.$quan.'-'.$total_quan;
        $newproduct->slug = $slug;
        $newproduct->content = $content;
        $newproduct->description = $description;
        $newproduct->quantity = $quantity;
        $newproduct->price = $price_cost;
        $newproduct->promotional = $price_promotional;
        $newproduct->id_type = $typeproduct;
        $newproduct->id_category = $categoryproduct;
        $newproduct->size = $sizeproduct;
        $newproduct->color = $colorproduct;
        $newproduct->id_vendor = Auth::user()->id;
        $newproduct->rate = 1;

        if( $request->hasFile('imgavatar') )
        {
            $file = $request->file('imgavatar');
            $filedetail = $file->getClientOriginalExtension('imgavatar');

            if( $filedetail == "jpg" || $filedetail == "png" || $filedetail == "jpeg" )
            {
                $file->move('public/assetF/images',$total_quan.'-'.Auth::user()->id."product.".$filedetail);
                $newproduct->image = $total_quan.'-'.Auth::user()->id."product.".$filedetail;
                $newproduct->save();
                $success = 'Updated Success';
                return redirect()->back()->with('success',$success);
            }
            else
            {
                $error = 'Updated Error';
                return redirect()->back()->with('error',$error);
            }
        }
        else
        {
            $error_img = 'Updated Error';
            return redirect('')->back()->with('error_img',$error_img);
        }
    }

    public function get_myproductlock_page()
    {
        $iduser = Auth::user()->id;
        $products = Product::select('id','slug','name','image','quantity','rate','id_category','price','promotional','id_type')->where([['id_vendor',$iduser],['status',0]])->get();
        return view('pagesF.vendor.myproduct',compact('products')); 
    }

    public function post_deleteproductvendor(Request $request)
    {
        $id_product = $request->idpro;
        $product = Product::find($id_product);
        $product->delete();

        $count = Product::select('id')->where('id_vendor',Auth::user()->id)->get();
        return response()->json(['success'=>'Delele Success !!','count'=>count($count)]);
    }

    public function get_revenue_page()
    {
        $months =  OrderDetail::select(\DB::raw('MONTHNAME(created_at) as Month'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->where('id_vendor',Auth::user()->id )->get();
        $arr_month = array();
        foreach ($months as $key => $value) 
        {
            array_push($arr_month, $value['Month']);
        }


        $sum_order =  OrderDetail::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('sum(quantity) as quantity'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->where('id_vendor',Auth::user()->id )->get();
        $arr_order = array();
        foreach ($sum_order as $key => $value) 
        {
            array_push($arr_order, $value['quantity']);
        }

        $sumrevenue =  OrderDetail::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('sum(quantity*money) as sum_money'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->where('id_vendor',Auth::user()->id )->get();

        $arr_revenue = array();
        foreach ($sumrevenue as $key => $value) 
        {
            array_push($arr_revenue, $value['sum_money']*0.9);
        }

        $products =  OrderDetail::select(\DB::raw('(id_product) as name'), \DB::raw('count(id_product) as coun_id'))->groupBy(\DB::raw("(id_product)"))->orderBy('name', 'DESC')->where('order_detail.id_vendor',Auth::user()->id )->get();

        $arr_product = array();
        $arr_count = array();
        foreach ($products as $key => $value) 
        {
            array_push($arr_product, $value['name']);
            array_push($arr_count, $value['coun_id']);
        }

        return view('pagesF.vendor.chartrevenue',compact('arr_month','arr_order','arr_revenue','arr_product','arr_count'));
    }

    public function get_signin()
    {
        if( Auth::check() )
        {
            return redirect('/');  
        }
        else
        {
            return view('pagesF.signin');
        } 
    }

    public function post_updateprofiled(Request $request)
    {
        if( Auth::check() )
        {
            $name = $request->name;
            $phone = $request->phone;
            $address = $request->address;

            $update_user = User::find( Auth::user()->id );
            $update_user->name = $name;
            $update_user->address = $address;
            $update_user->phone = $phone;

            if( $request->hasFile('imgavatar') )
            {
                $file = $request->file('imgavatar');
                $filedetail = $file->getClientOriginalExtension('imgavatar');

                if( $filedetail == "jpg" || $filedetail == "png" || $filedetail == "jpeg" )
                {
                    $file->move('public/assetF/images/avatar',Auth::user()->id.".".$filedetail);
                    $update_user->avatar = Auth::user()->id.".".$filedetail;
                }
                else
                {
                    $error = 'Updated Error';
                    return redirect()->back()->with('error',$error);
                }
            }

            $update_user->save();

            $success = 'Updated Success';
            return redirect()->back()->with('success',$success);
        }
        else
        {
            return redirect('/'); 
        } 
    }
}
