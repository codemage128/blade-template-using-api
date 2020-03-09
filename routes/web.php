<?php
include_once 'web_builder.php';
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
Route::pattern('slug', '[a-z0-9- _]+');
Route::pattern('slug', '[a-z0-9- _]+');

Route::group(['prefix' => '1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i', 'namespace' => 'Admin'], function () {
    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return view('admin/404');
    });
    Route::get('500', function () {
        return view('admin/500');
    });
    # Lock screen
    Route::get('{id}/lockscreen', 'UsersController@lockscreen')->name('lockscreen');
    Route::post('{id}/lockscreen', 'UsersController@postLockscreen')->name('lockscreen');
    # All basic routes defined here
    Route::get('login', 'AuthController@getSignin')->name('login');
//    Route::get('login', function (){ return view('admin/500');})->name('login');
    Route::get('signin', 'AuthController@getSignin')->name('signin');
    Route::post('signin', 'AuthController@postSignin')->name('postSignin');
    Route::post('signup', 'AuthController@postSignup')->name('1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i.signup');
    Route::post('forgot-password', 'AuthController@postForgotPassword')->name('forgot-password');
//    Route::get('login2', function () {
//        return view('admin/login2');
//    });
//    Route::get('{provider}', 'AuthController@redirectToProvider');
//    Route::get('{provider}/callback', 'AuthController@handleProviderCallback');
    # Register2
    Route::get('register2', function () {
        return view('admin/register2');
    });
    Route::post('register2', 'AuthController@postRegister2')->name('register2');
    # Forgot Password Confirmation
    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');
    # Logout
    Route::get('logout', 'AuthController@getLogout')->name('logout');
    # Account Activation
    Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
});
Route::group(['prefix' => '1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i', 'middleware' => 'admin', 'as' => 'admin.'], function () {
    # GUI Crud Generator
    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('generator_builder');
    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate');
    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate');
    // Model checking
    Route::post('modelCheck', 'ModelcheckController@modelCheck');
    # Dashboard / Index
    Route::get('/product', 'JoshController@showHome')->name('dashboard');
    Route::get('/product/fillter/{id}', 'JoshController@showHome2')->name('dashboard2');
    Route::post('/product/clearPrice/', 'JoshController@clearPrice')->name('clear_price');
    Route::post('/product/getProductInfo', 'JoshController@getProductInfo')->name('getProductInfo');
    Route::post('/product/delProductInfo', 'JoshController@delProductInfo')->name('delProductInfo');
    Route::post('/product/updateProductInfo', 'JoshController@updateProductInfo')->name('updateProductInfo');
    Route::post('/product/addProductInfo', 'JoshController@addProductInfo')->name('addProductInfo');
    Route::get('/product/editimage/{id}', 'JoshController@editimage')->name('editimage');
    Route::get('/product/editprice/{id}', 'JoshController@editprice')->name('editprice');
    Route::get('/product/removeprice/{id}', 'JoshController@removeprice')->name('removeprice');
    Route::post('/product/addprice/{id}', 'JoshController@addprice')->name('addprice');
    Route::post('/product/updateimage', 'JoshController@updateimage')->name('updateimage');
    Route::get('/otpinfo', 'JoshController@otpinfo')->name('otpinfo');
    Route::post('/otpinfo/save', 'JoshController@optinfo_save')->name('otpinfo.save');

    Route::post('/viewinfo/news', 'JoshController@save_news')->name('save.news');
    Route::get('/viewinfo', 'JoshController@viewinfo')->name('viewinfo');
    Route::post('/viewinfo/save', 'JoshController@viewinfo_save')->name('viewinfo.save');

    Route::get('/manage', 'JoshController@manage')->name('manage');
    Route::post('/manage/save', 'JoshController@manage_save')->name('manage_save');
    Route::post('/transactions', 'JoshController@getTransactionInfo')->name('getTransactionInfo');
    Route::post('/transactions/delete', 'JoshController@delTransaction')->name('delTransaction');
    Route::get('transaction/index', 'JoshController@showTransaction')->name('transaction');
    Route::get('transaction/{id}', 'JoshController@showTransaction2')->name('transaction2');
    # crop demo
    Route::post('crop_demo', 'JoshController@crop_demo')->name('crop_demo');
    //Log viewer routes
    Route::get('/log/logclient', 'JoshController@logclient')->name('logclient');
    \
    Route::get('/log/logclient/filter', 'JoshController@filter_date')->name('filter_date');
    //end Log viewer
    # Activity log
    Route::get('activity_log/data', 'JoshController@activityLogData')->name('activity_log.data');
//    Route::get('/', 'JoshController@index')->name('index');
});
Route::group(['prefix' => '1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i', 'namespace' => 'Admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {

    # User Management
    Route::group(['prefix' => 'users'], function () {
        Route::get('data', 'UsersController@data')->name('users.data');
        Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
        Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
        Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
        Route::post('passwordreset', 'UsersController@passwordreset')->name('passwordreset');

    });
    Route::resource('users', 'UsersController');

    Route::get('deleted_users', ['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');

    # Group Management
    Route::group(['prefix' => 'groups'], function () {
        Route::get('{group}/delete', 'GroupsController@destroy')->name('groups.delete');
        Route::get('{group}/confirm-delete', 'GroupsController@getModalDelete')->name('groups.confirm-delete');
        Route::get('{group}/restore', 'GroupsController@getRestore')->name('groups.restore');
    });
    Route::resource('groups', 'GroupsController');

    /*routes for blog*/
    Route::group(['prefix' => 'blog'], function () {
        Route::get('{blog}/delete', 'BlogController@destroy')->name('blog.delete');
        Route::get('{blog}/confirm-delete', 'BlogController@getModalDelete')->name('blog.confirm-delete');
        Route::get('{blog}/restore', 'BlogController@restore')->name('blog.restore');
        Route::post('{blog}/storecomment', 'BlogController@storeComment')->name('storeComment');
    });
    Route::resource('blog', 'BlogController');
    /*routes for blog category*/
    Route::group(['prefix' => 'blogcategory'], function () {
        Route::get('{blogCategory}/delete', 'BlogCategoryController@destroy')->name('blogcategory.delete');
        Route::get('{blogCategory}/confirm-delete', 'BlogCategoryController@getModalDelete')->name('blogcategory.confirm-delete');
        Route::get('{blogCategory}/restore', 'BlogCategoryController@getRestore')->name('blogcategory.restore');
    });
    Route::resource('blogcategory', 'BlogCategoryController');
    /*routes for file*/
    Route::group(['prefix' => 'file'], function () {
        Route::post('create', 'FileController@store')->name('store');
        Route::post('createmulti', 'FileController@postFilesCreate')->name('postFilesCreate');
        Route::delete('delete', 'FileController@delete')->name('delete');
    });
    /*routes for News*/
    Route::group(['prefix' => 'news'], function () {
        Route::get('data', 'NewsController@data')->name('news.data');
        Route::get('{news}/delete', 'NewsController@destroy')->name('news.delete');
        Route::get('{news}/confirm-delete', 'NewsController@getModalDelete')->name('news.confirm-delete');
    });
    Route::resource('news', 'NewsController');

    Route::get('crop_demo', function () {
        return redirect('admin/imagecropping');
    });
    /* laravel example routes */
    #Charts
    Route::get('laravel_chart', 'ChartsController@index')->name('laravel_chart');
    Route::get('database_chart', 'ChartsController@databaseCharts')->name('database_chart');

    # datatables
    Route::get('datatables', 'DataTablesController@index')->name('index');
    Route::get('datatables/data', 'DataTablesController@data')->name('datatables.data');
    # datatables
    Route::get('jtable/index', 'JtableController@index')->name('index');
    Route::post('jtable/store', 'JtableController@store')->name('store');
    Route::post('jtable/update', 'JtableController@update')->name('update');
    Route::post('jtable/delete', 'JtableController@destroy')->name('delete');
    # SelectFilter
    Route::get('selectfilter', 'SelectFilterController@index')->name('selectfilter');
    Route::get('selectfilter/find', 'SelectFilterController@filter')->name('selectfilter.find');
    Route::post('selectfilter/store', 'SelectFilterController@store')->name('selectfilter.store');
    # editable datatables
    Route::get('editable_datatables', 'EditableDataTablesController@index')->name('index');
    Route::get('editable_datatables/data', 'EditableDataTablesController@data')->name('editable_datatables.data');
    Route::post('editable_datatables/create', 'EditableDataTablesController@store')->name('store');
    Route::post('editable_datatables/{id}/update', 'EditableDataTablesController@update')->name('update');
    Route::get('editable_datatables/{id}/delete', 'EditableDataTablesController@destroy')->name('editable_datatables.delete');
//    # custom datatables
    Route::get('custom_datatables', 'CustomDataTablesController@index')->name('index');
    Route::get('custom_datatables/sliderData', 'CustomDataTablesController@sliderData')->name('custom_datatables.sliderData');
    Route::get('custom_datatables/radioData', 'CustomDataTablesController@radioData')->name('custom_datatables.radioData');
    Route::get('custom_datatables/selectData', 'CustomDataTablesController@selectData')->name('custom_datatables.selectData');
    Route::get('custom_datatables/buttonData', 'CustomDataTablesController@buttonData')->name('custom_datatables.buttonData');
    Route::get('custom_datatables/totalData', 'CustomDataTablesController@totalData')->name('custom_datatables.totalData');
    //tasks section
    Route::post('task/create', 'TaskController@store')->name('store');
    Route::get('task/data', 'TaskController@data')->name('data');
    Route::post('task/{task}/edit', 'TaskController@update')->name('update');
    Route::post('task/{task}/delete', 'TaskController@delete')->name('delete');
});
# Remaining pages will be called from below controller method
# in real world scenario, you may be required to define all routes manually
Route::group(['prefix' => '1m93fLGAHMX8E16Ycruzfi1d6df9cjH9i', 'middleware' => 'admin'], function () {
    Route::get('{name?}', 'JoshController@showView');
});
#FrontEndController
//Route::get('register', 'FrontEndController@getRegister')->name('register');
//Route::post('register','FrontEndController@postRegister')->name('register');
Route::get('register', function () {
    return view('404');
})->name('register');

Route::get('login', 'FrontEndController@getLogin')->name('login');
Route::get('login2', 'FrontEndController@getLogin2')->name('login2');
Route::post('login', 'FrontEndController@postLogin')->name('login');
Route::post('login2', 'FrontEndController@postLogin2')->name('login2');

//Route::group(['middleware' => 'user'], function () {
    Route::get('/home', ['as' => 'home', function () {
        return view('index');
    }]);
    Route::get('/', ['as' => 'products', function () {
        return redirect('/home');
    }]);
    Route::get('sendhtmlemail', 'MailController@html_email');
    Route::get('{name?}', 'FrontEndController@showFrontEndView');
    Route::post('/payment/{productid}', 'FrontEndController@payment')->name('payment');
    Route::get('/view_product/{id}', 'FrontEndController@showViewProduct')->name('single_product');
    Route::get('/confirm/{id}', 'FrontEndController@confirmandback')->name('confirm');
    Route::get('/payconfirm/{id}', 'FrontEndController@payconfirm')->name('payconfirm');
//});
Route::get('/payment/btc_callback', 'FrontEndController@btcCallback');
Route::get('/sms/sendemail', 'FrontEndController@sendEmail');
# End of frontend views
