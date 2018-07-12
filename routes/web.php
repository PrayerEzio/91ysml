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

Route::resource('test/index','Test\IndexController');

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
    });
};

$home_public_group = function(){
    Route::get('/','IndexController@index')->name('Home.Index.index');
    Route::get('/category/{id}','IndexController@category');
    Route::get('/articles','ArticleController@index');
    Route::get('/article/{id}','ArticleController@show');
    Route::get('/product/{id}','GoodsController@show');
    Route::group(['prefix' => 'Goods'],function(){
        Route::get('/','GoodsController@index');
        Route::get('/{id}','GoodsController@show');
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
        Route::get('/cancelOrder/{sn}','OrderController@cancelOrder')->name('Home.Order.cancelOrder');
    });
    Route::group(['prefix' => 'Member'],function(){
        Route::get('/index','MemberController@index')->name('Home.Member.index');
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
    Route::group(['prefix' => 'Mail'],function(){
        Route::get('/','MailController@inbox');
        Route::get('/inbox','MailController@inbox');
        Route::get('/index','MailController@inbox');
        Route::get('/detail','MailController@mail_detail');
        Route::get('/mail_detail','MailController@mail_detail');
        Route::get('/mail_compose','MailController@mail_compose');
    });
    Route::group(['prefix' => 'Auth'],function(){
        $controller = 'Auth';
        Route::get('/admin_list',"{$controller}Controller@admin_list");
        Route::get('/permission_list',"{$controller}Controller@permission_list");
        Route::get('/role_list',"{$controller}Controller@role_list");
        Route::get('/admin_show/{id}',"{$controller}Controller@admin_show");
        Route::post('/admin_store/{id}',"{$controller}Controller@admin_store");
        Route::post('/admin_avatar_upload',"{$controller}Controller@admin_avatar_upload");
    });
    Route::group(['prefix' => 'Article'],function(){
        $controller = 'Article';
        Route::get('/index',"{$controller}Controller@index");
        Route::get('/{slug}',"{$controller}Controller@show");
    });
};

$admin_public_group = function(){
    Route::group(['prefix' => 'Login'],function(){
        Route::get('/','LoginController@index')->name('admin.login.index');
        Route::get('/index','LoginController@index');
        Route::get('/register','LoginController@register');
        Route::post('/index','LoginController@index');
        Route::post('/register','LoginController@register');
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

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin.login','admin.permission']],$admin_private_group);

Route::group(['prefix' => 'Admin','namespace' => 'Admin','middleware' => ['admin.login','admin.permission']],$admin_private_group);

Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => ['admin.login','admin.permission']],$admin_private_group);