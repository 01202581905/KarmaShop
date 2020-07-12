<?php

use App\Http\Middleware\CheckAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Client

Route::get('/',
		[
			'as'	=> 'index',
			'uses'	=> 'ClientController@get_index_page' //done
		]);

Route::post('/loadmoreproduct',
		[
			'as'	=> 'loadmoreproduct',
			'uses'	=> 'ClientController@get_loadmoreproduct' //done
		]);

Route::get('/karmaproduct',
		[
			'as'	=> 'product',
			'uses'	=> 'ClientController@get_product_page' //done
		]);

Route::get('/detailproduct/{slug}',
		[
			'as'	=> 'detailproduct',
			'uses'	=> 'ClientController@get_detailproduct_page' //done
		]);

Route::get('/category/{slug}',
		[
			'as'	=> 'categoryproduct',
			'uses'	=> 'ClientController@get_categoryproduct_page' //done
		]);

Route::get('/type/{slug}',
		[
			'as'	=> 'typeproduct',
			'uses'	=> 'ClientController@get_typeproduct_page' //done
		]);

Route::get('/vendors/{slug}',
		[
			'as'	=> 'detailvendor',
			'uses'	=> 'ClientController@get_vendor_page' //done
		]);

Route::post('/selecttypes',
		[
			'as'	=> 'selecttypessearch',
			'uses'	=> 'ClientController@post_selecttypessearch' //done
		]);

Route::get('/cart',
		[
			'as'	=> 'cart',
			'uses'	=> 'ClientController@get_cart_page' //done
		]);


Route::get('/search',
		[
			'as'	=> 'searchallproduct',
			'uses'	=> 'ClientController@get_searchallproduct_page' //done
		]);

Route::post('/submitcontact',
		[
			'as'	=> 'submitcontactform',
			'uses'	=> 'ClientController@post_contact_page' //done
		]);

Route::post('/postcomment',
		[
			'as'	=> 'postcomment',
			'uses'	=> 'ClientController@post_postcomment_page' //done
		]);

Route::get('/about',
		[
			'as'	=> 'about',
			'uses'	=> 'ClientController@get_about_page' //done
		]);

Route::get('/contact',
		[
			'as'	=> 'contact',
			'uses'	=> 'ClientController@get_contact_page' //done
		]);

Route::get('/login',
		[
			'as'	=> 'login',
			'uses'	=> 'ClientController@get_login_page' //done
		]);

Route::post('/check',
		[
			'as'	=> 'checklogin',
			'uses'	=> 'ClientController@post_checklogin_page' //done
		]);

Route::get('/logout',
		[
			'as'	=> 'logout',
			'uses'	=> 'ClientController@get_logout' //done
		]);

Route::get('/signin',
		[
			'as' 	=> 'signinaccount',
			'uses'	=> 'ClientController@get_signin'
		]);

Route::get('/suggestopenshop',
		[
			'as' 	=> 'waitreply',
			'uses'	=> 'ClientController@get_suggestopenshop'
		]);


Route::post('/signin',
		[
			'as' 	=> 'signin',
			'uses'	=> 'ClientController@post_signin'
		]);


Route::post('/updateprofiled',
		[
			'as' 	=> 'updateprofiled',
			'uses'	=> 'ClientController@post_updateprofiled'
		]);



//Customer
Route::get('/myaccount',
		[
			'as'	=> 'infocustomer',
			'uses'	=> 'ClientController@get_infocustomer_page'
		]);

Route::get('/myorder',
		[
			'as'	=> 'ordercustomer',
			'uses'	=> 'ClientController@get_ordercustomer_page'
		]);

Route::get('/changepassword',
		[
			'as'	=> 'changepassword',
			'uses'	=> 'ClientController@get_password_page'
		]);

Route::post('/addcart',
		[
			'as'	=> 'addcart',
			'uses'	=> 'ClientController@post_addcart_function'
		]);

Route::get('/clearcart',
		[
			'as'	=> 'clearcart',
			'uses'	=> 'ClientController@get_clearcart_function'
		]);

Route::post('/updatecart',
		[
			'as'	=> 'updatecart',
			'uses'	=> 'ClientController@post_updatecart_function'
		]);

Route::post('/order',
		[
			'as'	=> 'order',
			'uses'	=> 'ClientController@post_order_function'
		]);

Route::post('/changepassword',
		[
			'as'	=> 'changepassword',
			'uses'	=> 'ClientController@post_changepassword_function'
		]);

Route::get('/newvendor',
		[
			'as'	=> 'newvendor',
			'uses'	=> 'ClientController@get_newvendor_function'
		]);

Route::post('/opennewshop',
		[
			'as'	=> 'submitopenshop',
			'uses'	=> 'ClientController@post_opennewvendor_function'
		]);





//Vendor
Route::group(['prefix'=>'/vendor','middleware'=>'vendorshop'],function(){

	Route::get('/dashboardvendor',
		[
			'as'	=> 'vendor',
			'uses'	=> 'ClientController@get_dashboardvendor_page'
		]);

	Route::get('/myinfovendor',
		[
			'as'	=> 'infovendor',
			'uses'	=> 'ClientController@get_infovendor_page'
		]);

	Route::get('/myordervendor',
		[
			'as'	=> 'infoordervendor',
			'uses'	=> 'ClientController@get_ordervendor_page'
		]);

	Route::get('/myorderconfirm',
		[
			'as'	=> 'myorderconfirm',
			'uses'	=> 'ClientController@get_myorderconfirm_page'
		]);

	Route::get('/cancelordervendor',
		[
			'as'	=> 'cancelordervendor',
			'uses'	=> 'ClientController@get_cancelordervendor_page'
		]);

	Route::get('/ordercompleted',
		[
			'as'	=> 'ordercompleted',
			'uses'	=> 'ClientController@get_ordercompleted_page'
		]);

	Route::get('/vendorsearchorder',
		[
			'as'	=> 'vendorsearchorder',
			'uses'	=> 'ClientController@get_vendorsearchorder_page'
		]);

	Route::post('/confirmorder',
		[
			'as'	=> 'confirmordervendor',
			'uses'	=> 'ClientController@post_confirmorder_json'
		]);

	Route::post('/cancelorder',
		[
			'as'	=> 'confirmordervendor',
			'uses'	=> 'ClientController@post_cancelorder_json'
		]);

	Route::get('/myproductvendor',
		[
			'as'	=> 'infoproductvendor',
			'uses'	=> 'ClientController@get_productvendor_page'
		]);

	Route::get('/myproductlock',
		[
			'as'	=> 'myproductlock',
			'uses'	=> 'ClientController@get_myproductlock_page'
		]);

	Route::get('/detailproductvendor',
		[
			'as'	=> 'detailproductvendor',
			'uses'	=> 'ClientController@get_infoproductvendor_page'
		]);

	Route::get('/myrevenue',
		[
			'as'	=> 'revenue',
			'uses'	=> 'ClientController@get_revenue_page'
		]);

	Route::get('/addnewproduct',
		[
			'as'	=> 'addnewproductvendor',
			'uses'	=> 'ClientController@get_addnewproduct_page'
		]);

	Route::post('/selecttypes',
		[
			'as'	=> 'selecttypesvendor',
			'uses'	=> 'ClientController@post_selecttypes_page'
		]);

	Route::post('/insertnewproduct',
		[
			'as'	=> 'insertnewproductvendor',
			'uses'	=> 'ClientController@post_insertnewproduct_page'
		]);

	Route::get('/updatemyproductvendor/{slug}',
		[
			'as'	=> 'updatemyproductvendor',
			'uses'	=> 'ClientController@get_updatemyproductvendor_page'
		]);

	Route::post('/updatedetailproductvendor',
		[
			'as'	=> 'updatedetailproductvendor',
			'uses'	=> 'ClientController@post_updatedetailproductvendor'
		]);

	Route::post('/deleteproduct',
		[
			'as'	=> 'deleteproductvendor',
			'uses'	=> 'ClientController@post_deleteproductvendor'
		]);

	Route::post('/updatedinfoshopvendor',
		[
			'as'	=> 'updatedinfoshopvendor',
			'uses'	=> 'ClientController@post_updatedinfoshopvendor'
		]);
});









//Server

Route::get('serverkarma/login',
		[
			'as'	=> 'serverlogin',
			'uses'	=> 'ServerController@getlogin'
		]);

Route::post('serverkarma/checklogin',
		[
			'as'	=> 'serverchecklogin',
			'uses'	=> 'ServerController@postlogin'
		]);




Route::group(['prefix'=>'/serverkarma','middleware'=>'admin'],function(){
	Route::get('/',
		[
			'as'	=> 'serverindex',
			'uses'	=> 'ServerController@getindex'
		]);

	Route::get('/',
		[
			'as'	=> 'serverindex',
			'uses'	=> 'ServerController@getindex'
		]);

	Route::get('/logout',
		[
			'as'	=> 'logoutadmin',
			'uses'	=> 'ServerController@getlogout'
		]);

	Route::get('/managerorderwait',
		[
			'as'	=> 'managerorderwait',
			'uses'	=> 'ServerController@getmanagerorderwait'
		]);

	Route::get('/managerorderwaitsearch',
		[
			'as'	=> 'searchorderwait',
			'uses'	=> 'ServerController@getsearchorderwait'
		]);

	Route::get('/managerordership',
		[
			'as'	=> 'managerordership',
			'uses'	=> 'ServerController@getmanagerordership'
		]);

	Route::get('/managerorderdelivered',
		[
			'as'	=> 'managerorderdelivered',
			'uses'	=> 'ServerController@managerorderdelivered'
		]);

	Route::get('/managerordercancel',
		[
			'as'	=> 'managerordercancel',
			'uses'	=> 'ServerController@getmanagerordercancel'
		]);

	Route::get('/managershop',
		[
			'as'	=> 'managershop',
			'uses'	=> 'ServerController@getmanagershop'
		]);

	Route::get('/searchshop',
		[
			'as'	=> 'searchshop',
			'uses'	=> 'ServerController@getsearchshop'
		]);

	Route::get('/managershoplock',
		[
			'as'	=> 'managershoplock',
			'uses'	=> 'ServerController@getmanagershoplock'
		]);

	Route::get('/managershopsuggest',
		[
			'as'	=> 'managershopsuggest',
			'uses'	=> 'ServerController@getmanagershopsuggest'
		]);

	Route::get('/managerrevenue',
		[
			'as'	=> 'managerrevenue',
			'uses'	=> 'ServerController@getmanagerrevenue'
		]);

	Route::get('/informyshop',
		[
			'as'	=> 'informyshop',
			'uses'	=> 'ServerController@getinformyshop'
		]);

	Route::get('/myproductshop',
		[
			'as'	=> 'myproductshop',
			'uses'	=> 'ServerController@getmyproductshop'
		]);

	Route::get('/managerallproduct',
		[
			'as'	=> 'managerallproduct',
			'uses'	=> 'ServerController@getmanagerallproduct'
		]);

	Route::get('/searchproduct',
		[
			'as'	=> 'searchproduct',
			'uses'	=> 'ServerController@getsearchproduct'
		]);

	Route::get('/managerallproductlock',
		[
			'as'	=> 'managerallproductlock',
			'uses'	=> 'ServerController@getmanagerallproductlock'
		]);

	Route::get('/managerallproductreport',
		[
			'as'	=> 'managerallproductreport',
			'uses'	=> 'ServerController@getmanagerallproductreport'
		]);

	Route::get('/managercatproduct',
		[
			'as'	=> 'managercatproduct',
			'uses'	=> 'ServerController@getmanagercatproduct'
		]);

	Route::get('/managertypeproduct',
		[
			'as'	=> 'managertypeproduct',
			'uses'	=> 'ServerController@getmanagertypeproduct'
		]);

	Route::get('/manageralluser',
		[
			'as'	=> 'manageralluser',
			'uses'	=> 'ServerController@getmanageralluser'
		]);

	Route::get('/searchuser',
		[
			'as'	=> 'searchuser',
			'uses'	=> 'ServerController@getsearchuser'
		]);

	Route::get('/manageralluserlock',
		[
			'as'	=> 'manageralluserlock',
			'uses'	=> 'ServerController@getmanageralluserlock'
		]);

	Route::get('/managercontact',
		[
			'as'	=> 'managercontact',
			'uses'	=> 'ServerController@getmanagercontact'
		]);

	Route::get('/searchcontact',
		[
			'as'	=> 'searchcontact',
			'uses'	=> 'ServerController@getsearchcontact'
		]);

	Route::post('/updatedinfoshop',
		[
			'as'	=> 'updatedinfoshop',
			'uses'	=> 'ServerController@postupdatedinfoshop'
		]);

	Route::post('/updatesuggest',
		[
			'as'	=> 'updateopenshop',
			'uses'	=> 'ServerController@postupdatesuggest'
		]);

	Route::post('/selecttypes',
		[
			'as'	=> 'selecttypes',
			'uses'	=> 'ServerController@post_get_selecttypes'
		]);

	Route::get('/updateproduct/{idproduct}',
		[
			'as'	=> 'updatemyproduct',
			'uses'	=> 'ServerController@getupdatemyproduct'
		]);

	Route::post('/updatedetailproduct',
		[
			'as'	=> 'updatedetailproduct',
			'uses'	=> 'ServerController@postupdatedetailproduct'
		]);

	Route::post('/deleteproduct',
		[
			'as'	=> 'deleteproduct',
			'uses'	=> 'ServerController@postdeleteproduct'
		]);

	Route::get('/addnewproduct',
		[
			'as'	=> 'addnewproduct',
			'uses'	=> 'ServerController@getaddnewproduct'
		]);

	Route::post('/createnewproduct',
		[
			'as'	=> 'insertnewproduct',
			'uses'	=> 'ServerController@postcreatenewproduct'
		]);

	Route::post('/lockproduct',
		[
			'as'	=> 'lockproduct',
			'uses'	=> 'ServerController@postlockproduct'
		]);

	Route::post('/ajaxdetailorder',
		[
			'as'	=> 'ajaxdetailorder',
			'uses'	=> 'ServerController@postajaxdetailorder'
		]);

	Route::post('/updatestatusorder',
		[
			'as'	=> 'updatestatusorder',
			'uses'	=> 'ServerController@postupdatestatusorder'
		]);

	Route::post('/updatestatusordercomplete',
		[
			'as'	=> 'updatestatusordercomplete',
			'uses'	=> 'ServerController@postupdatestatusordercomplete'
		]);

	Route::post('/updatestatusordercancel',
		[
			'as'	=> 'updatestatusordercancel',
			'uses'	=> 'ServerController@postupdatestatusordercancel'
		]);

	Route::post('/unlockproduct',
		[
			'as'	=> 'unlockproduct',
			'uses'	=> 'ServerController@postunlockproduct'
		]);

	Route::post('/createnewcat',
		[
			'as'	=> 'createnewcat',
			'uses'	=> 'ServerController@postcreatenewcat'
		]);

	Route::post('/lockuser',
		[
			'as'	=> 'lockuser',
			'uses'	=> 'ServerController@postlockuser'
		]);

	Route::post('/unlockuser',
		[
			'as'	=> 'unlockuser',
			'uses'	=> 'ServerController@postunlockuser'
		]);

});
