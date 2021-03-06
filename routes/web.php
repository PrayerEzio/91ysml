<?php

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

$test_group = function(){
    Route::get('/','IndexController@index');
    Route::group(['prefix' => 'Index'],function(){
        Route::get('/','IndexController@index');
        Route::get('/index','IndexController@index');
        Route::get('/setRedis','IndexController@setRedis');
        Route::get('/getRedis/{id}','IndexController@getRedis');
        Route::get('/getAdminModel/{id}','IndexController@getAdminModel');
        Route::get('/getAdminModel','IndexController@getAdminModel');
        Route::get('/getArticleModel','IndexController@getArticleModel');
        Route::get('/qiniu','IndexController@qiniu');
        Route::get('/addPermission','IndexController@addPermission')->name('test.index.add_permission');
        Route::get('/addRole','IndexController@addRole')->name('test.index.add_role');
        Route::get('/createRoleAndPermission','IndexController@createRoleAndPermission');
        Route::get('/adminAssignRole','IndexController@adminAssignRole');
        Route::get('/givePermissionToRole','IndexController@givePermissionToRole');
        Route::get('/roleHasPermission','IndexController@roleHasPermission');
        Route::get('/adminHasPermission','IndexController@adminHasPermission');
        Route::get('/geoip','IndexController@geoip')->name('test.index.geoip');
        Route::get('/getGoods/{id}','IndexController@getGoods')->name('test.index.get_goods');
        Route::get('/getProduct/{id}','IndexController@getProduct')->name('test.index.get_product');
        Route::get('/seed','IndexController@seed')->name('test.index.seed');
        Route::get('/getOrder/{order_sn}','IndexController@getOrder')->name('test.index.get_order');
        Route::get('/cart','IndexController@cart')->name('test.index.cart');
        Route::get('/test','IndexController@test')->name('test.index.test');
    });
    Route::group(['prefix' => 'Chubao'],function(){
        Route::get('/getChannelCode','ChubaoController@getChannelCode');
        Route::get('/getToken','ChubaoController@getToken');
        Route::get('/getRoomList','ChubaoController@getRoomList');
        Route::get('/enterRoom/{room_id}','ChubaoController@enterRoom');
        Route::get('/leaveRoom/{room_id}','ChubaoController@leaveRoom');
        Route::get('/sitDown/{room_id}','ChubaoController@sitDown');
        Route::get('/standUp/{room_id}','ChubaoController@standUp');
        Route::get('/dropCoin/{room_id}','ChubaoController@dropCoin');
        Route::get('/test','ChubaoController@test');
    });
};

$home_public_group = function(){
    Route::get('/','IndexController@index')->name('Home.Index.index');
    Route::get('/category/{id}','IndexController@category');
    Route::get('/articles','ArticleController@index');
    Route::get('/article/{id}','ArticleController@show');
    Route::get('/product/{goods_sn}','GoodsController@show');
    Route::group(['prefix' => 'Goods'],function(){
        Route::get('/','GoodsController@index');
        Route::get('/{goods_sn}','GoodsController@show');
    });
    Route::group(['prefix' => 'Cart'],function(){
        Route::post('/index','CartController@index')->name('Home.Cart.index');
        Route::get('/index','CartController@index')->name('Home.Cart.index');
        Route::post('/add','CartController@create')->name('Home.Cart.add');
        Route::post('/remove','CartController@delete')->name('Home.Cart.remove');
        Route::post('/update','CartController@update')->name('Home.Cart.update');
        Route::get('/destroy','CartController@destroy')->name('Home.Cart.destroy');
    });
    Route::group(['prefix' => 'Ajax'],function(){
        Route::post('/getRegionsList','AjaxController@getRegionsList')->name('Home.Ajax.getRegionsList');
        Route::post('/getOrderDetail','AjaxController@getOrderDetail')->name('Home.Ajax.getOrderDetail');
        Route::post('/getArticleCategoryList','AjaxController@getArticleCategoryList')->name('Home.Ajax.getArticleCategoryList');
        Route::post('/getGoodsCategoryList','AjaxController@getGoodsCategoryList')->name('Home.Ajax.getGoodsCategoryList');
    });
    Route::group(['prefix' => 'Login'],function(){
        Route::get('/','LoginController@index')->name('Home.Login.index');
        Route::get('/index','LoginController@index');
        Route::get('/register','LoginController@register');
        Route::post('/index','LoginController@index');
        Route::post('/register','LoginController@register');
    });
    Route::group(['prefix' => 'Webhook'],function(){
        Route::post('/github','WebhookController@github');
    });
};

$home_private_group = function (){
    Route::group(['prefix' => 'Order'],function(){
        Route::get('/checkout','OrderController@checkout')->name('Home.Order.checkout');
        Route::post('/create','OrderController@create')->name('Home.Order.create');
        Route::get('/getList','OrderController@getList')->name('Home.Order.getList');
        Route::get('/detail/{sn}','OrderController@detail')->name('Home.Order.detail');
        Route::get('/payOrder/{sn}','OrderController@payOrder')->name('Home.Order.payOrder');
        Route::post('/payOrder/{sn}','OrderController@payOrder')->name('Home.Order.payOrder');
        Route::delete('/cancelOrder/{sn}','OrderController@cancelOrder')->name('Home.Order.cancelOrder');
    });
    Route::group(['prefix' => 'Member'],function(){
        $controller = 'Member';
        Route::get('/index',"{$controller}Controller@index")->name("Home.{$controller}.index");
        Route::post('/index',"{$controller}Controller@index")->name("Home.{$controller}.update");
        Route::get('/wallet',"{$controller}Controller@wallet")->name("Home.{$controller}.wallet");
        Route::get('/collect_list',"{$controller}Controller@collectList")->name("Home.{$controller}.collect_list");
        Route::get('/address_list',"{$controller}Controller@addressList")->name("Home.{$controller}.address_list");
        Route::get('/reset_password',"{$controller}Controller@resetPassword")->name("Home.{$controller}.reset_password");
        Route::get('/logout',"{$controller}Controller@logout")->name("Home.{$controller}.logout");
    });
    Route::group(['prefix' => 'Ajax'],function(){
        Route::post('/saveAddress','AjaxController@saveAddress')->name('Home.Ajax.saveAddress');
        Route::post('/getOrderDetail','AjaxController@getOrderDetail')->name('Home.Ajax.getOrderDetail');
    });
};

$admin_private_group = function(){
    Route::get('/','IndexController@index');
    Route::get('/logout','IndexController@logout');
    Route::group(['prefix' => 'Index'],function(){
        Route::get('/','IndexController@index');
        Route::get('/index','IndexController@index');
        Route::get('/about_us','IndexController@about_us');
        Route::get('/billboard','IndexController@billboard');
    });
    Route::group(['prefix' => 'Statistics'], function () {
        $controller = 'Statistics';
        Route::get('/index', "{$controller}Controller@index");
        Route::post('/recharge', "{$controller}Controller@recharge");
        Route::post('/order', "{$controller}Controller@order");
        Route::post('/order_chart', "{$controller}Controller@order_chart");
        Route::post('/user', "{$controller}Controller@user");
    });
    Route::group(['prefix' => 'Auth'],function(){
        $controller = 'Auth';
        Route::get('/admin_list',"{$controller}Controller@admin_list");
        Route::get('/permission_list',"{$controller}Controller@permission_list");
        Route::get('/permission_create',"{$controller}Controller@permission_create");
        Route::post('/permission_create',"{$controller}Controller@permission_create");
        Route::get('/permission_edit/{id}',"{$controller}Controller@permission_edit");
        Route::post('/permission_edit/{id}',"{$controller}Controller@permission_edit");
        Route::delete('/permission_delete',"{$controller}Controller@permission_delete");
        Route::get('/role_list',"{$controller}Controller@role_list");
        Route::get('/role_create',"{$controller}Controller@role_create");
        Route::post('/role_create',"{$controller}Controller@role_create");
        Route::get('/role_edit/{id}',"{$controller}Controller@role_edit");
        Route::post('/role_edit/{id}',"{$controller}Controller@role_edit");
        Route::delete('/role_delete',"{$controller}Controller@role_delete");
        Route::get('/admin_show/{id}',"{$controller}Controller@admin_show");
        Route::post('/admin_store/{id}',"{$controller}Controller@admin_store");
        Route::post('/admin_avatar_upload',"{$controller}Controller@admin_avatar_upload");
    });
    Route::group(['prefix' => 'Article'],function(){
        $controller = 'Article';
        Route::get('/index',"{$controller}Controller@index");
        Route::get('/add',"{$controller}Controller@add");
        Route::post('/add',"{$controller}Controller@add");
        Route::get('/edit/{id}',"{$controller}Controller@edit");
        Route::post('/edit/{id}',"{$controller}Controller@edit");
        Route::get('/addCate',"{$controller}Controller@addCate");
        Route::post('/addCate',"{$controller}Controller@addCate");
        Route::get('/addCate/{id}',"{$controller}Controller@addCate");
        Route::post('/addCate/{id}',"{$controller}Controller@addCate");
        Route::get('/editCate/{id}',"{$controller}Controller@editCate");
        Route::post('/editCate/{id}',"{$controller}Controller@editCate");
        Route::get('/cateList',"{$controller}Controller@cateList");
        Route::delete('/delete',"{$controller}Controller@delete");
        Route::delete('/deleteCate',"{$controller}Controller@deleteCate");
        Route::get('/{slug}',"{$controller}Controller@show");
    });
    Route::group(['prefix' => 'Goods'],function(){
        $controller = 'Goods';
        Route::get('/addGoods',"{$controller}Controller@addGoods");
        Route::post('/addGoods',"{$controller}Controller@addGoods");
        Route::get('/editGoods/{id}',"{$controller}Controller@editGoods");
        Route::post('/editGoods/{id}',"{$controller}Controller@editGoods");
        Route::get('/addGoodsPicture/{goods_id}',"{$controller}Controller@addGoodsPicture");
        Route::post('/addGoodsPicture/{goods_id}',"{$controller}Controller@addGoodsPicture");
        Route::get('/editGoodsPicture/{id}',"{$controller}Controller@editGoodsPicture");
        Route::post('/editGoodsPicture/{id}',"{$controller}Controller@editGoodsPicture");
        Route::get('/addCategory',"{$controller}Controller@addCategory");
        Route::post('/addCategory',"{$controller}Controller@addCategory");
        Route::get('/addCategory/{id}',"{$controller}Controller@addCategory");
        Route::post('/addCategory/{id}',"{$controller}Controller@addCategory");
        Route::get('/editCategory/{id}',"{$controller}Controller@editCategory");
        Route::post('/editCategory/{id}',"{$controller}Controller@editCategory");
        Route::get('/goodsCategoryList',"{$controller}Controller@goodsCategoryList");
        Route::get('/goodsList/{id}',"{$controller}Controller@goodsList");
        Route::get('/goodsList',"{$controller}Controller@goodsList");
        Route::get('/goodsPictureList/{goods_id}',"{$controller}Controller@goodsPictureList");
        Route::get('/goodsPictureList',"{$controller}Controller@goodsPictureList");
        Route::delete('/deleteGoods',"{$controller}Controller@deleteGoods");
        Route::delete('/deleteGoodsPicture',"{$controller}Controller@deleteGoodsPicture");
        Route::delete('/deleteGoodsCategory',"{$controller}Controller@deleteGoodsCategory");
        Route::get('/synMatProduct',"{$controller}Controller@synMatProduct");
    });
    Route::group(['prefix' => 'Attribute'],function(){
        $controller = 'Attribute';
        Route::get('/addAttribute',"{$controller}Controller@addAttribute");
        Route::post('/addAttribute',"{$controller}Controller@addAttribute");
        Route::get('/editAttribute/{id}',"{$controller}Controller@editAttribute");
        Route::post('/editAttribute/{id}',"{$controller}Controller@editAttribute");
        Route::get('/addCategory',"{$controller}Controller@addCategory");
        Route::post('/addCategory',"{$controller}Controller@addCategory");
        Route::get('/editCategory/{id}',"{$controller}Controller@editCategory");
        Route::post('/editCategory/{id}',"{$controller}Controller@editCategory");
        Route::get('/attributeCategoryList',"{$controller}Controller@attributeCategoryList");
        Route::get('/attributeList/{id}',"{$controller}Controller@attributeList");
        Route::delete('/deleteAttribute',"{$controller}Controller@deleteAttribute");
        Route::delete('/deleteAttributeCategory',"{$controller}Controller@deleteAttributeCategory");
    });
    Route::group(['prefix' => 'Order'],function(){
        $controller = 'Order';
        Route::get('/orderList',"{$controller}Controller@orderList")->name("Admin.{$controller}.orderList");
        Route::get('/detail/{sn}',"{$controller}Controller@detail")->name("Admin.{$controller}.detail");
        Route::delete('/cancelOrder/{sn}',"{$controller}Controller@cancelOrder")->name("Admin.{$controller}.cancelOrder");
        Route::post('/nextStatus',"{$controller}Controller@nextStatus")->name("Admin.{$controller}.nextStatus");
    });
    Route::group(['prefix' => 'SystemLog'],function(){
        $controller = 'SystemLog';
        Route::get('/index',"{$controller}Controller@index")->name("Admin.{$controller}.index");
        Route::post('/detail/{id}',"{$controller}Controller@detail")->name("Admin.{$controller}.detail");
    });
    Route::group(['prefix' => 'System'],function(){
        $controller = 'System';
        Route::get('/phpinfo',"{$controller}Controller@phpinfo")->name("Admin.{$controller}.phpinfo");
        Route::get('/tz',"{$controller}Controller@tz")->name("Admin.{$controller}.tz");
    });
    Route::group(['prefix' => 'Ajax'],function(){
        $controller = 'Ajax';
        Route::post('/getGoodsCategoryList',"{$controller}Controller@getGoodsCategoryList")->name("Admin.{$controller}.getGoodsCategoryList");
        Route::post('/getAttributesList',"{$controller}Controller@getAttributesList")->name("Admin.{$controller}.getOrderDetail");
    });
    Route::resource('User', 'UserController');
    Route::resource('Advertisement', 'AdvertisementController');
    Route::resource('Album', 'AlbumController');
    Route::resource('AlbumPicture', 'AlbumPictureController');
};

$admin_public_group = function(){
    Route::group(['prefix' => 'Login'],function(){
        Route::get('/','LoginController@index')->name('admin.login.index');
        Route::post('/', 'LoginController@loginHandle');
        Route::get('/index','LoginController@index');
        Route::post('/index', 'LoginController@loginHandle');
        Route::get('/register','LoginController@register');
        Route::post('/register', 'LoginController@registerHandle');
        Route::get('/github', 'LoginController@redirectToProvider');
        Route::get('/github/callback', 'LoginController@handleProviderCallback');
    });
};

Route::group(['prefix' => 'Test','namespace' => 'Test'],$test_group);

Route::group(['prefix' => 'test','namespace' => 'Test'],$test_group);

Route::group(['prefix' => '','namespace' => 'Home'],$home_public_group);

Route::group(['prefix' => 'Home','namespace' => 'Home'],$home_public_group);

Route::group(['prefix' => 'home','namespace' => 'Home'],$home_public_group);

Route::group(['prefix' => '','namespace' => 'Home','middleware' => ['home.login']],$home_private_group);

Route::group(['prefix' => 'Home','namespace' => 'Home','middleware' => ['home.login']],$home_private_group);

Route::group(['prefix' => 'home','namespace' => 'Home','middleware' => ['home.login']],$home_private_group);

Route::group(['prefix' => 'Admin','namespace' => 'Admin'],$admin_public_group);

Route::group(['prefix' => 'admin','namespace' => 'Admin'],$admin_public_group);

Route::group(['prefix' => 'Admin','namespace' => 'Admin','middleware' => ['admin.login','admin.permission']],$admin_private_group);

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin.login','admin.permission']],$admin_private_group);