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
    Route::group(['prefix'=>'fundraising_unit','middleware'=>['role:1']],function (){
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
        Route::group(['prefix'=>'currency'],function (){
            Route::get('index',[App\Http\Controllers\CurrencyController::class , 'index'])->name('settings.currency.index');
            Route::get('add',[App\Http\Controllers\CurrencyController::class , 'add'])->name('settings.currency.add');
            Route::post('create',[App\Http\Controllers\CurrencyController::class , 'create'])->name('settings.currency.create');
            Route::get('edit/{id}',[App\Http\Controllers\CurrencyController::class , 'edit'])->name('settings.currency.edit');
            Route::post('update',[App\Http\Controllers\CurrencyController::class , 'update'])->name('settings.currency.update');
        });
        Route::group(['prefix'=>'cites'],function (){
            Route::get('index',[App\Http\Controllers\CitesController::class , 'index'])->name('settings.cites.index');
            Route::get('add',[App\Http\Controllers\CitesController::class , 'add'])->name('settings.cites.add');
            Route::post('create',[App\Http\Controllers\CitesController::class , 'create'])->name('settings.cites.create');
            Route::get('edit/{id}',[App\Http\Controllers\CitesController::class , 'edit'])->name('settings.cites.edit');
            Route::post('update',[App\Http\Controllers\CitesController::class , 'update'])->name('settings.cites.update');
        });
        Route::group(['prefix'=>'places'],function (){
            Route::get('index',[App\Http\Controllers\PlacesController::class , 'index'])->name('settings.places.index');
            Route::get('add',[App\Http\Controllers\PlacesController::class , 'add'])->name('settings.places.add');
            Route::post('create',[App\Http\Controllers\PlacesController::class , 'create'])->name('settings.places.create');
            Route::get('edit/{id}',[App\Http\Controllers\PlacesController::class , 'edit'])->name('settings.places.edit');
            Route::post('update',[App\Http\Controllers\PlacesController::class , 'update'])->name('settings.places.update');
        });
        Route::group(['prefix'=>'type_of_beneficiaries'],function (){
            Route::get('index',[App\Http\Controllers\TypeOfBeneficiariesController::class , 'index'])->name('settings.type_of_beneficiaries.index');
            Route::get('add',[App\Http\Controllers\TypeOfBeneficiariesController::class , 'add'])->name('settings.type_of_beneficiaries.add');
            Route::post('create',[App\Http\Controllers\TypeOfBeneficiariesController::class , 'create'])->name('settings.type_of_beneficiaries.create');
            Route::get('edit/{id}',[App\Http\Controllers\TypeOfBeneficiariesController::class , 'edit'])->name('settings.type_of_beneficiaries.edit');
            Route::post('update',[App\Http\Controllers\TypeOfBeneficiariesController::class , 'update'])->name('settings.type_of_beneficiaries.update');
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
        Route::post('list_other_image_ajax',[App\Http\Controllers\MediaReportController::class , 'list_other_image_ajax'])->name('media_report.list_other_image_ajax');
        Route::post('get_activites_if_selected_project_ajax',[App\Http\Controllers\MediaReportController::class , 'get_activites_if_selected_project_ajax'])->name('media_report.get_activites_if_selected_project_ajax');
        Route::post('delete_other_attachment_ajax',[App\Http\Controllers\MediaReportController::class , 'delete_other_attachment_ajax'])->name('media_report.delete_other_attachment_ajax');
    });
    Route::group(['prefix'=>'projects'],function (){
        Route::get('index',[App\Http\Controllers\ProjectsController::class , 'index'])->name('projects.index');
        Route::post('project_table_ajax',[App\Http\Controllers\ProjectsController::class , 'project_table_ajax'])->name('projects.project_table_ajax');
        Route::get('add',[App\Http\Controllers\ProjectsController::class , 'add'])->name('projects.add');
        Route::post('create',[App\Http\Controllers\ProjectsController::class , 'create'])->name('projects.create');
        Route::get('edit/{id}',[App\Http\Controllers\ProjectsController::class , 'edit'])->name('projects.edit');
        Route::post('update',[App\Http\Controllers\ProjectsController::class , 'update'])->name('projects.update');
    });
    Route::group(['prefix'=>'activity'],function (){
        Route::get('index',[App\Http\Controllers\ActivityController::class , 'index'])->name('activity.index');
        Route::get('add',[App\Http\Controllers\ActivityController::class , 'add'])->name('activity.add');
        Route::post('create',[App\Http\Controllers\ActivityController::class , 'create'])->name('activity.create');
        Route::get('edit/{id}',[App\Http\Controllers\ActivityController::class , 'edit'])->name('activity.edit');
        Route::post('update',[App\Http\Controllers\ActivityController::class , 'update'])->name('activity.update');
    });
    Route::group(['prefix'=>'project_activity'],function (){
        Route::get('index',[App\Http\Controllers\ProjectActivityController::class , 'index'])->name('project_activity.index');
        Route::get('add',[App\Http\Controllers\ProjectActivityController::class , 'add'])->name('project_activity.add');
        Route::post('create',[App\Http\Controllers\ProjectActivityController::class , 'create'])->name('project_activity.create');
        Route::get('edit/{id}',[App\Http\Controllers\ProjectActivityController::class , 'edit'])->name('project_activity.edit');
        Route::post('update',[App\Http\Controllers\ProjectActivityController::class , 'update'])->name('project_activity.update');
    });
    Route::post('/upload/image',[App\Http\Controllers\UploadController::class , 'upload'])->name('upload.image');
});

Route::get('/generate', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});
