<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Carbon;

use App\ProductCategory;
use App\ProductType;
use App\User;
use App\Contact;
use App\Product;
use App\Order;
use App\OrderDetail;

class ServerController extends Controller
{
    public function getindex()
    {
        $orders = Order::select('code_order','avatar','name_recipient','total_quantity','total_money','code_order','order.status','status_order')->join('users','users.id','=','order.id_user')->limit(8)->get();
        $products = Product::select('id')->where('status','1')->get();
        $clients = User::select('id')->where('status',1)->where('rule',0)->get();
        $countorder = Order::select('id')->get();
        $revenue = Order::where('status',2)->where('status_order',1)->sum('total_money');
        $vendors = User::select('id')->where('status_shop',1)->count();
        $users = User::select('id')->where('status',1)->count();
        $daynow = Carbon\Carbon::today()->format('Y-m-d');
        $monthnow = Carbon\Carbon::today()->format('Y-m');
        $todaysale = Order::select('id')->where('created_at','like','%'.$daynow.'%')->count();

        $todayrevenue = Order::where('status',1)->where('status_order',1)->where('created_at','like','%'.$daynow.'%')->sum('total_money');
        $newuser = User::where('status',1)->where('rule',0)->where('created_at','like','%'.$monthnow.'%')->count();

        $months =  Order::select(\DB::raw('MONTHNAME(created_at) as Month'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->get();

        $sumorder =  Order::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('sum(total_money) as sum_money'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->get();

        $countorderjs =  Order::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('count(id) as count_order'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->get();

        $arr_month = array();
        $arr_order = array();
        $arr_countorder = array();
        $arr_revenue = array();

        foreach ($months as $key => $value) 
        {
            array_push($arr_month, $value['Month']);
        }

        foreach ($sumorder as $key => $value) 
        {
            array_push($arr_order, $value['sum_money']);
            array_push($arr_revenue, $value['sum_money']*0.1);
        }

        foreach ($countorderjs as $key => $value) 
        {
            array_push($arr_countorder, $value['count_order']);
        }

        return view('pagesB.dashboard',compact('orders','products','clients','countorder','revenue','vendors','users','todaysale','todayrevenue','newuser','arr_month','arr_order','arr_countorder','arr_revenue'));
    }

    public function getlogin()
    {
        if( Auth::check() )
        {
            return redirect()->back();
        }
        else
    	   return view('pagesB.signin');
    }

    public function getlogout()
    {
        if( Auth::check() )
        {
            Auth::logout();
            return redirect('serverkarma/login');
        }
        else
        {
            return redirect('serverkarma/login');
        }  
    }

    public function postlogin(Request $request)
    {
        $username =  $request['username'];
        $password =  $request['password'];

        if( Auth::attempt(['email'=>$username,'password'=>$password,'rule'=>1,'status'=>1]) )
        {

            return redirect('serverkarma/');
        }
        else
        {
            $error = 'password or username wrong !';
            return view('pagesB.signin',compact('error'));
        }
    }

    public function getmanagerorderwait()
    {
        $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','created_at')->where('status',0)->where('status_order',1)->get();
        $nameorder = 'Order Pending';
        $type = 'wait';
        return view('pagesB.managerorder',compact('orders','nameorder','type'));
    }

    public function getsearchorderwait(Request $request)
    {
        $nameorder = $request->nameorder;
        if( $nameorder == 'wait' )
        {
            $orders = Order::select('id','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at')->where('status',0)->where('status_order',1)->where('code_order','like','%'.$request->codeorder.'%')->get();
            $type = 'wait';
            $nameorder = 'Order Pending';
        }
        elseif( $nameorder == 'shipping' )
        {
            $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at',)->where('status',1)->where('status_order',1)->where('code_order','like','%'.$request->codeorder.'%')->get();
            $type = 'shipping';
            $nameorder = 'Order Being Delivered';
        }
        elseif( $nameorder == 'delivered' )
        {
            $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at',)->where('status',2)->where('status_order',1)->where('code_order','like','%'.$request->codeorder.'%')->get();
            $type = 'complete';
            $nameorder = 'Order Delivered';
        }
        elseif( $nameorder == 'cancel' )
        {
            $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at',)->where('status_order',0)->where('code_order','like','%'.$request->codeorder.'%')->get();
            $type = 'cancel';
            $nameorder = 'Order Cancel';
        }
        return view('pagesB.managerorder',compact('orders','nameorder','type'));
    }

    public function getmanagerordership()
    {
        $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at',)->where('status',1)->where('status_order',1)->get();
        $nameorder = 'Order Being Delivered';
        $type = "shipping";
        return view('pagesB.managerorder',compact('orders','nameorder','type'));
    }

    public function managerorderdelivered()
    {
        $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at',)->where('status',2)->where('status_order',1)->get();
        $nameorder = 'Order Delivered';
        $type = "complete";
        return view('pagesB.managerorder',compact('orders','nameorder','type'));
    }

    public function getmanagerordercancel()
    {
        $orders = Order::select('id','code_order','id_user','address','name_recipient','email','phone','letter','total_money','total_quantity','payment_method','fee','created_at',)->where('status_order',0)->where('status',0)->get();
        $nameorder = 'Order Cancel';
        $type = "cancel";
        return view('pagesB.managerorder',compact('orders','nameorder','type'));
    }

    public function getmanagershop()
    {
        $shops = User::select('id','name_shop','phone_shop','address_shop','mail_shop',)->where('status_shop',1)->get();
        $name = 'Shop';
        return view('pagesB.managershop',compact('shops','name'));
    }


    public function getsearchshop(Request $request)
    {
        $typeshop = $request->t;
        if( $typeshop == 'shop' )
        {

            $shops = User::select('id','name_shop','phone_shop','address_shop','mail_shop')->where('status_shop',1)->where('name_shop','like','%'.$request->nameshop.'%')->get();
            $name = 'Shop';
            return view('pagesB.managershop',compact('shops','name'));
        }
        elseif( $typeshop == 'lock' )
        {
            $shops = User::select('id','name_shop','phone_shop','address_shop','mail_shop')->where('locked',1)->where('name_shop','like','%'.$request->nameshop.'%')->get();
            $name = 'Shop Locked';
            return view('pagesB.managershop',compact('shops','name'));
        }
        elseif( $typeshop == 'shop1' )
        {

        }
    }


    public function getmanagershoplock()
    {
        $shops = User::select('id','name_shop','phone_shop','address_shop','mail_shop')->where('locked',1)->get();
        $name = 'Shop Locked';
        return view('pagesB.managershop',compact('shops','name'));
    }

    public function postajaxdetailorder(Request $request)
    {
        $order_details = OrderDetail::select('order_detail.status','order_detail.id','order_detail.money','order_detail.quantity','order_detail.size','order_detail.color','name','image')->where('id_order',$request->id_order)->join('producs','producs.id','=','order_detail.id_product')->get();
        return response()->json(['order_details'=>$order_details]);
    }

    public function postupdatestatusorder(Request $request)
    {
        $order = Order::find($request->id_order);
        $order->status = 1;
        $order->status_order = 1;
        $order->save();
        $order_wait = Order::where('status',0)->where('status_order',1)->count();
        return response()->json(['order_wait'=>$order_wait]);
    }

    public function postupdatestatusordercomplete(Request $request)
    {
        $order = Order::find($request->id_order);
        $order->status = 2;
        $order->status_order = 1;
        $order->save();
        $order_wait = Order::where('status',1)->where('status_order',1)->count();
        return response()->json(['order_wait'=>$order_wait]);
    }

    public function postupdatestatusordercancel(Request $request)
    {
        $order = Order::find($request->id_order);
        $order->status = 0;
        $order->status_order = 0;
        $order->save();
        $order_wait = Order::where('status',1)->where('status_order',1)->count();
        return response()->json(['order_wait'=>$order_wait]);
    }

    public function getmanagershopsuggest()
    {
        $shops = User::select('users.id','users.name_shop','users.phone_shop','users.address_shop','users.mail_shop','openshop.letter')->join('openshop','users.id','=','openshop.id_user')->where('users.pending',1)->get();
        $name = 'Suggest Active Shop';
        $suggest = true;
        return view('pagesB.managershop',compact('shops','name','suggest'));
    }

    public function getmanagerrevenue()
    {
         $months =  Order::select(\DB::raw('MONTHNAME(created_at) as Month'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->get();

        $sumorder =  Order::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('sum(total_money) as sum_money'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->get();

        $countorderjs =  Order::select(\DB::raw('MONTHNAME(created_at) as Month'), \DB::raw('count(id) as count_order'))->whereYear('created_at', '=', date('Y'))->groupBy(\DB::raw("MONTHNAME(created_at)"))->orderBy('Month', 'DESC')->get();

        $products =  OrderDetail::select(\DB::raw('(id_product) as name'), \DB::raw('count(id_product) as coun_id'))->groupBy(\DB::raw("(id_product)"))->orderBy('name', 'DESC')->get()->take(5);

        $arr_month = array();
        $arr_order = array();
        $arr_countorder = array();
        $arr_revenue = array();
        $arr_product = array();
        $arr_count = array();

        foreach ($months as $key => $value) 
        {
            array_push($arr_month, $value['Month']);
        }

        foreach ($sumorder as $key => $value) 
        {
            array_push($arr_order, $value['sum_money']);
            array_push($arr_revenue, $value['sum_money']*0.1);
        }

        foreach ($countorderjs as $key => $value) 
        {
            array_push($arr_countorder, $value['count_order']);
        }

        foreach ($products as $key => $value) 
        {
            array_push($arr_product, $value['name']);
            array_push($arr_count, $value['coun_id']);
        }

        return view('pagesB.chartrevenue',compact('arr_month','arr_order','arr_revenue','arr_countorder','arr_count','arr_product'));
    }

    public function getinformyshop()
    {
        return view('pagesB.profilemyshop');
    }

    public function getmyproductshop()
    {
        $id_vendor = Auth::user()->id;
        $products = Product::select('id','name','slug','image','quantity','price','promotional')->where('id_vendor',$id_vendor)->get();
        return view('pagesB.myproduct',compact('products'));
    }

    public function getmanagerallproduct()
    {
        $products = Product::select('id','name','slug','image','id_vendor','price','promotional')->where('status',1)->get();
        $name = 'Product';
        return view('pagesB.allproduct',compact('products','name'));
    }

    public function getsearchproduct(Request $request)
    {
        $type = $request->t;
        if( $type == 'product' )
        {
            $products = Product::select('id','name','slug','image','id_vendor','price','promotional')->where('status',1)->where('name','like','%'.$request->nameproduct.'%')->get();
            $name = 'Product';
            return view('pagesB.allproduct',compact('products','name'));
        }
        elseif( $type == 'lock' )
        {
            $products = Product::select('id','name','slug','image','id_vendor')->where('status',0)->where('name','like','%'.$request->nameproduct.'%')->get();
            $name = 'Product Locked';
            return view('pagesB.allproduct',compact('products','name'));
        }

    }

    public function getmanagerallproductlock()
    {
        $products = Product::select('id','name','slug','image','id_vendor')->where('status',0)->get();
        $name = 'Product Locked';
        return view('pagesB.allproduct',compact('products','name'));
    }

    public function getmanagerallproductreport()
    {
        return view('pagesB.master');;
    }

    public function post_get_selecttypes(Request $request)
    {
        $types = ProductType::select('name','id')->where('id_category',$request->idcat)->get();
        return response()->json(['types'=>$types]);
    }

    public function postlockuser(Request $request)
    {
        $user = User::find($request->iduser);
        $user->status = 0;
        $user->save();
        $count = User::select('id')->where('status',1)->get();
        return response()->json(['count'=>count($count)]);
    }


    public function postunlockuser(Request $request)
    {
        $user = User::find($request->iduser);
        $user->status = 1;
        $user->save();
        $count = User::select('id')->where('status',0)->get();

        return response()->json(['count'=>count($count)]);
    }

    public function getmanagercatproduct()
    {
        $cats = ProductCategory::select('id','name','slug')->get();
        $types = ProductType::select('id','name','slug','id_category')->get();
        return view('pagesB.categoryproduct',compact('cats','types'));
    }

    public function getmanageralluser()
    {
        $users = User::select('status','id','name','email','address','phone','status_shop')->where('status','=',1)->get();
        $name = 'User';
        return view('pagesB.manageruser',compact('users','name'));
    }

    public function getsearchuser(Request $request)
    {
        $type = $request->t;
        if( $type == 'users' )
        {
            $users = User::select('status','id','name','email','address','phone','status_shop')->where('status','=',1)->where('name','like','%'.$request->mailuser.'%')->get();
            $name = 'User';
            return view('pagesB.manageruser',compact('users','name'));
        }
        elseif( $type == 'lock' )
        {
            $users = User::select('id','status','name','email','address','phone','status_shop')->where('status','=',0)->where('name','like','%'.$request->mailuser.'%')->get();
            $name = 'User Lock';
            return view('pagesB.manageruser',compact('users','name'));
        }
    }   

    public function postcreatenewcat(Request $request)
    {
        $parent = $request->parentcat;
        $name = $request->namecat_type;

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

        if( $parent == 0 )
        {
            $newcat = new ProductCategory;
            $newcat->name = $name;
            $newcat->slug = $slug;
            $newcat->save();
            $success = 'Create New Category Product Success !';
            return redirect()->back()->with('success',$success);
        }
        else
        {
            $newtype = new ProductType;
            $newtype->name = $name;
            $newtype->slug = $slug;
            $newtype->id_category = $parent;
            $newtype->save();
            $success = 'Create New Type Product Success !';
            return redirect()->back()->with('success',$success);
        }
        
    }    

    public function getmanageralluserlock()
    {
        $users = User::select('id','status','name','email','address','phone','status_shop')->where('status','=',0)->get();
        $name = 'User Lock';
        return view('pagesB.manageruser',compact('users','name'));
    }

    public function getmanagercontact()
    {
        $contacts = Contact::select('name','mail','message','created_at')->get();
        return view('pagesB.contact',compact('contacts'));
    }

    public function getsearchcontact(Request $request)
    {
        $contacts = Contact::select('name','mail','message','created_at')->where('mail','like','%'.$request->contact.'%')->get();
        return view('pagesB.contact',compact('contacts'));
    } 

    public function postupdatesuggest(Request $request)
    {
        $id_suggest = $request->id_suggest;
        $user = User::find($id_suggest);
        $user->pending = 0;
        $user->status_shop = 1;
        $user->save();
        $count = User::select('id')->where('pending',1)->get();
        return response()->json(['success'=>'Update Success !!','count'=>count($count)]);
    } 

    public function postdeleteproduct(Request $request)
    {
        $id_product = $request->idpro;
        $product = Product::find($id_product);
        $product->delete();

        $count = Product::select('id')->where('id_vendor',Auth::user()->id)->get();
        return response()->json(['success'=>'Delele Success !!','count'=>count($count)]);
    }

    public function postlockproduct(Request $request)
    {
        $id_product = $request->idpro;
        $product = Product::find($id_product);
        $product->status = 0;
        $product->save();

        $count = Product::select('id')->where('status',1)->get();
        return response()->json(['success'=>'Delele Success !!','count'=>count($count)]);
    }

    public function postunlockproduct(Request $request)
    {
        $id_product = $request->idpro;
        $product = Product::find($id_product);
        $product->status = 1;
        $product->save();

        $count = Product::select('id')->where('status',0)->get();
        return response()->json(['success'=>'Delele Success !!','count'=>count($count)]);
    } 

    public function getupdatemyproduct($idproduct)
    {
        $detail_product = Product::where('slug',$idproduct)->where('id_vendor',Auth::user()->id )->select('id','name','price','promotional','image','description','content','quantity','id_type','id_category')->first();
        $cats = ProductCategory::select('name','id')->get();
        $types = ProductType::select('name','id')->where('id_category',$detail_product->id_category)->get();
        return view('pagesB.detailproduct',compact('detail_product','cats','types'));
    }

    public function getaddnewproduct()
    {
        $cats = ProductCategory::select('id','name','slug')->get();
        $types = ProductType::select('id','name','slug','id_category')->get();
        return view('pagesB.addnewproduct',compact('cats','types'));
    }

    public function postcreatenewproduct(Request $request)
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
        if( $quan == null )
        {
            $quan == 0;
        }
        $quan = $quan++;
        $slug = $slug.'-'.Auth::user()->id.'-COZA-'.$quan;
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
                $file->move('public/assetF/images',$newproduct->id."product.".$filedetail);
                $newproduct->image = $newproduct->id."product.".$filedetail;
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


    public function postupdatedetailproduct(Request $request)
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
                return redirect('/serverkarma/myproductshop')->with('success',$success);
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
            return redirect('/serverkarma/myproductshop')->with('success',$success);
        }
    }

    public function postupdatedinfoshop(Request $request)
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
}
