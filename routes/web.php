<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PersonsController;
use App\Http\Controllers\Admin\ProductsController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','admin'])->group(function(){

      //Dashboard
      Route::controller(DashboardController::class)->group(function(){
        Route::get('dashboard','Index')->name('admin.dashboard');
    });

    //Person
    Route::controller(PersonsController::class)->group(function(){
        Route::get('persons/','Index')->name('admin.person_index');
        Route::get('person-add','Add')->name('admin.person_add');
        Route::post('person-store','Store')->name('admin.person_store');
        Route::get('person-edit/{id}','Edit')->name('admin.person_edit');
        Route::post('person-update','Update')->name('admin.person_update');
        Route::get('person-delete/{id}','Delete')->name('admin.person_delete');
        Route::get('person-view','Person')->name('person_view');
        Route::post('person-search','Search')->name('admin.person_search');
    });

    //Products
    Route::controller(ProductsController::class)->group(function(){
        Route::get('products','index')->name('admin.product_index');
        Route::get('product-add','Add')->name('admin.product_add');
        Route::get('product-edit','Edit')->name('admin.product_edit');
        Route::get('product-update','Update')->name('admin.product_update');
        Route::get('product-delete','Delete')->name('admin.product_delete');
        Route::get('product-view','product')->name('admin.product_view');
    });
});
