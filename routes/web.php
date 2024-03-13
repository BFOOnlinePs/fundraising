<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (!auth()->check()){
        return view('auth.login');
    }
    else{
        return redirect()->route('home');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>'auth'],function (){
    Route::group(['prefix'=>'fundraising_unit'],function (){
        Route::group(['prefix'=>'donors'],function (){
            Route::get('index',[App\Http\Controllers\DonorsController::class , 'index'])->name('fundraising_unit.donors.index');
            Route::post('donors_table_ajax',[App\Http\Controllers\DonorsController::class , 'donors_table_ajax'])->name('fundraising_unit.donors.donors_table_ajax');
            Route::post('create',[App\Http\Controllers\DonorsController::class , 'create'])->name('fundraising_unit.donors.create');
            Route::post('contact_person_create_ajax',[App\Http\Controllers\DonorsController::class , 'contact_person_create_ajax'])->name('fundraising_unit.donors.contact_person_create_ajax');
            Route::post('contact_person_table_ajax',[App\Http\Controllers\DonorsController::class , 'contact_person_table_ajax'])->name('fundraising_unit.donors.contact_person_table_ajax');
            Route::post('update',[App\Http\Controllers\DonorsController::class , 'update'])->name('fundraising_unit.donors.update');
            Route::get('details/{id}',[App\Http\Controllers\DonorsController::class , 'details'])->name('fundraising_unit.donors.details');
            Route::post('import_donors_to_excel',[App\Http\Controllers\DonorsController::class , 'import_donors_to_excel'])->name('fundraising_unit.donors.import_donors_to_excel');
            Route::group(['prefix'=>'donors_category'],function (){
                Route::get('index',[App\Http\Controllers\DonorsCategoryController::class , 'index'])->name('fundraising_unit.donors.donors_category.index');
                Route::post('create',[App\Http\Controllers\DonorsCategoryController::class , 'create'])->name('fundraising_unit.donors.donors_category.create');
                Route::post('donors_category_table_ajax',[App\Http\Controllers\DonorsCategoryController::class , 'donors_category_table_ajax'])->name('fundraising_unit.donors.donors_category.donors_category_table_ajax');
                Route::post('update',[App\Http\Controllers\DonorsCategoryController::class , 'update'])->name('fundraising_unit.donors.donors_category.update');
            });
        });
    });
    Route::group(['prefix'=>'settings'],function (){
        Route::group(['prefix'=>'region'],function (){
            Route::get('index',[App\Http\Controllers\RegionController::class , 'index'])->name('settings.region.index');
            Route::post('create',[App\Http\Controllers\RegionController::class , 'create'])->name('settings.region.create');
            Route::post('update',[App\Http\Controllers\RegionController::class , 'update'])->name('settings.region.update');
            Route::post('region_table_ajax',[App\Http\Controllers\RegionController::class , 'region_table_ajax'])->name('settings.region.region_table_ajax');
        });
    });
});
