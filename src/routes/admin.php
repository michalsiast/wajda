<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Auth::routes(['register' => false]);
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin', 'auth']], function () {

    Route::post('/setstatus', 'Controller@SetStatus')->name('setstatus');

    Route::post('/change-order/{table}', 'IndexController@changeOrder')->name('change_order');
    Route::post('/change-lang', 'IndexController@changeLang')->name('change_lang');


    Route::get('/', 'IndexController@index')->name('dashboard');
    Route::get('/setting', 'IndexController@settings')->name('settings');


    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'UserController@show')->name('show');
        Route::post('/', 'UserController@edit')->name('edit');
    });


    Route::group(['prefix' => 'const-field', 'as' => 'const_field.'], function () {
        Route::get('/', 'ConstFieldController@index')->name('index');
        Route::post('/', 'ConstFieldController@edit')->name('edit');
    });

    Route::group(['prefix' => 'smtp-settings', 'as' => 'smtp_settings.'], function () {
        Route::get('/', 'ConfigController@smtpSettingsIndex')->name('index');
        Route::post('/', 'ConfigController@smtpSettingsEdit')->name('edit');
    });

    Route::group(['prefix' => 'google-app-settings', 'as' => 'google_app_settings.'], function () {
        Route::get('/', 'ConfigController@googleAppSettingsIndex')->name('index');
        Route::post('/', 'ConfigController@googleAppSettingsEdit')->name('edit');
    });



    Route::group(['prefix' => 'pages', 'as' => 'page.'], function () {
        Route::get('/', 'PageController@index')->name('index');
        Route::get('/create', 'PageController@create')->name('create');
        Route::get('/{id}', 'PageController@show')->name('show');
        Route::post('/{id?}', 'PageController@edit')->name('edit');
        Route::get('/{id}/delete', 'PageController@delete')->name('delete');
    });


    Route::group(['prefix' => 'articles', 'as' => 'article.'], function () {
        Route::get('/', 'ArticleController@index')->name('index');
        Route::get('/create', 'ArticleController@create')->name('create');
        Route::get('/{id}', 'ArticleController@show')->name('show');
        Route::post('/{id?}', 'ArticleController@edit')->name('edit');
        Route::get('/{id}/delete', 'ArticleController@delete')->name('delete');
    });


    Route::group(['prefix' => 'article_categories', 'as' => 'article_category.'], function () {
        Route::get('/', 'ArticleCategoryController@index')->name('index');
        Route::get('/create', 'ArticleCategoryController@create')->name('create');
        Route::get('/{id}', 'ArticleCategoryController@show')->name('show');
        Route::post('/{id?}', 'ArticleCategoryController@edit')->name('edit');
        Route::get('/{id}/delete', 'ArticleCategoryController@delete')->name('delete');
    });


    Route::group(['prefix' => 'site_langs', 'as' => 'site_lang.'], function () {
        Route::get('/', 'SiteLangController@index')->name('index');
        Route::get('/create', 'SiteLangController@create')->name('create');
        Route::get('/{id}', 'SiteLangController@show')->name('show');
        Route::post('/{id?}', 'SiteLangController@edit')
            ->middleware('configCache')
            ->name('edit');
        Route::get('/{id}/delete', 'SiteLangController@delete')->name('delete');
    });


    Route::group(['prefix' => 'offers', 'as' => 'offer.'], function () {
        Route::get('/', 'OfferController@index')->name('index');
        Route::get('/create', 'OfferController@create')->name('create');
        Route::get('/{id}', 'OfferController@show')->name('show');
        Route::post('/{id?}', 'OfferController@edit')->name('edit');
        Route::get('/{id}/delete', 'OfferController@delete')->name('delete');
    });


    Route::group(['prefix' => 'offer_categories', 'as' => 'offer_category.'], function () {
        Route::get('/', 'OfferCategoryController@index')->name('index');
        Route::get('/create', 'OfferCategoryController@create')->name('create');
        Route::get('/{id}', 'OfferCategoryController@show')->name('show');
        Route::post('/{id?}', 'OfferCategoryController@edit')->name('edit');
        Route::get('/{id}/delete', 'OfferCategoryController@delete')->name('delete');
    });

    Route::group(['prefix' => 'rotator', 'as' => 'rotator.'], function () {
        Route::get('/', 'RotatorController@index')->name('index');
        Route::get('/create', 'RotatorController@create')->name('create');
        Route::get('/{id}', 'RotatorController@show')->name('show');
        Route::post('/{id?}', 'RotatorController@edit')->name('edit');
        Route::get('/{id}/delete', 'RotatorController@delete')->name('delete');
    });

    Route::group(['prefix' => 'realizations', 'as' => 'realization.'], function () {
        Route::get('/', 'RealizationController@index')->name('index');
        Route::get('/create', 'RealizationController@create')->name('create');
        Route::get('/{id}', 'RealizationController@show')->name('show');
        Route::post('/{id?}', 'RealizationController@edit')->name('edit');
        Route::get('/{id}/delete', 'RealizationController@delete')->name('delete');
    });


    Route::group(['prefix' => 'realization_categories', 'as' => 'realization_category.'], function () {
        Route::get('/', 'RealizationCategoryController@index')->name('index');
        Route::get('/create', 'RealizationCategoryController@create')->name('create');
        Route::get('/{id}', 'RealizationCategoryController@show')->name('show');
        Route::post('/{id?}', 'RealizationCategoryController@edit')->name('edit');
        Route::get('/{id}/delete', 'RealizationCategoryController@delete')->name('delete');
    });


    Route::group(['prefix' => 'nav-items', 'as' => 'nav_item.'], function () {
        Route::get('/{navName}/', 'NavItemController@index')->name('index');
        Route::get('/{navName}/create/{parentId?}', 'NavItemController@create')->name('create');
        Route::get('/{navName}/{id}', 'NavItemController@show')->name('show');
        Route::post('/{navName}/{id?}', 'NavItemController@edit')->name('edit');
        Route::get('/{navName}/{id}/delete', 'NavItemController@delete')->name('delete');
    });


});


