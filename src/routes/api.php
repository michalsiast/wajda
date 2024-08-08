<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/contact-form', 'FormController@contactForm');



Route::get('/gallery/{id}', 'Admin\GalleryController@getById');

Route::get('/gallery-item/{id}/{width}/{height}/{objectFit}', 'Admin\GalleryItemController@getPublicPath');
Route::post('/gallery-item/{gallery_id}', 'Admin\GalleryItemController@store');
Route::post('/gallery-item/{id}/update', 'Admin\GalleryItemController@update');
Route::delete('/gallery-item/{gallery_item_id}', 'Admin\GalleryItemController@delete');


