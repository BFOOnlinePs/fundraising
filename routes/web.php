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
    Route::group(['prefix'=>'users'],function (){
        Route::get('index',[App\Http\Controllers\UserController::class , 'index'])->name('users.index');
        Route::post('users_table_ajax',[App\Http\Controllers\UserController::class , 'users_table_ajax'])->name('users.users_table_ajax');
        Route::post('create',[App\Http\Controllers\UserController::class , 'create'])->name('users.create');
        Route::get('edit/{id}',[App\Http\Controllers\UserController::class , 'edit'])->name('users.edit');
        Route::post('update',[App\Http\Controllers\UserController::class , 'update'])->name('users.update');
    });
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
    Route::group(['prefix'=>'media_report'],function (){
        Route::get('index',[App\Http\Controllers\MediaReportController::class , 'index'])->name('media_report.index');
        Route::post('media_report_table_ajax',[App\Http\Controllers\MediaReportController::class , 'media_report_table_ajax'])->name('media_report.media_report_table_ajax');
        Route::get('add',[App\Http\Controllers\MediaReportController::class , 'add'])->name('media_report.add');
        Route::post('create',[App\Http\Controllers\MediaReportController::class , 'create'])->name('media_report.create');
        Route::get('edit/{id}',[App\Http\Controllers\MediaReportController::class , 'edit'])->name('media_report.edit');
        Route::post('update',[App\Http\Controllers\MediaReportController::class , 'update'])->name('media_report.update');
        Route::get('details/{id}',[App\Http\Controllers\MediaReportController::class , 'details'])->name('media_report.details');
        Route::post('approved_media_report',[App\Http\Controllers\MediaReportController::class , 'approved_media_report'])->name('media_report.approved_media_report');
        Route::post('delete_image_ajax',[App\Http\Controllers\MediaReportController::class , 'delete_image_ajax'])->name('media_report.delete_image_ajax');
        Route::post('attachment_ajax',[App\Http\Controllers\MediaReportController::class , 'attachment_ajax'])->name('media_report.attachment_ajax');
    });
});
