<?php
/**
 * Created by PhpStorm.
 * User: zipman
 * Date: 21.03.18
 * Time: 11:11
 */


//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin.')->group(function (){

    Route::get('/', 'DashboardController@index')->name('showData');

    // Метод для отображение списка настроек
    Route::get('/setting', 'SettingController@showSetting')->name('setting.showSetting');



    // Метод для отображения и сохранения списка настроек
    Route::post('/setting/store', 'SettingController@storeSetting')->name('setting.storeSetting');

    Route::post('setting/setWebHook', 'SettingController@setWebHook')->name('setting.setWebHook');

    Route::post('setting/getWebHookInfo', 'SettingController@getWebHookInfo')->name('setting.getWebHookInfo');



    // Метод для отображения клиентов
    Route::get('/clients', 'ClientsController@showClients')->name('showClients');

    // Метод для отображения клиентам курьеров
    Route::get('/couriers', 'CouriersController@showCouriers')->name('showCouriers');

    Route::get('/couriers/edit/{id?}', 'CouriersController@editCourier')->name('editCourier');

    Route::post('/couriers/store', 'CouriersController@storeCourier')->name('storeCourier');

    Route::get('/couriers/{id?}', 'CouriersController@deleteCourier')->name('deleteCourier');



    // Методы для отображение работы с заказами
    Route::get('/orders', 'OrdersController@showOrders')->name('showOrders');

    Route::get('/order/create', 'OrdersController@createOrder')->name('createOrder');

    Route::post('/orders', 'OrdersController@createOneOrder')->name('createOneOrder');

    Route::get('/oneOrder/{id?}', 'OrdersController@showOneOrder')->name('showOneOrder');

    Route::get('/order/edit/{id?}', 'OrdersController@editOrder')->name('editOrder');

    Route::post('/order/', 'OrdersController@editOneOrder')->name('editOneOrder');

    Route::get('/order/{id?}', 'OrdersController@deleteOrder')->name('deleteOrder');


    // Help for Company about API
    Route::get('/help', 'HelpCompanyController@helpCompany')->name('helpCompany');

    Route::get('/adminMap', 'AdminMapController@index')->name('adminMap');

    Route::get('/iFrame', 'IFrameController@iFrame')->name('iFrame');

});

// -----------------------------------------------------------------

// Routers for frontend

Route::get('/contacts', 'ContactsController@contacts')->name('contacts');

Route::get('/about', 'AboutController@about')->name('about');


Route::post(Telegram::getAccessToken(), function (){

//    Telegram::commandsHandler(true);

    app('App\Http\Controllers\Backend\TelegramLocationCourier')->webHook();

});


