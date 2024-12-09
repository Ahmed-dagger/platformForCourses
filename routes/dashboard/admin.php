<?php

use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){
        Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {

            Route::get('dashboard', Dashboard\DashboardController::class)->name('dashboard');

            Route::resource('admins', Dashboard\AdminController::class);

            Route::delete('destroy/{id}' , [Dashboard\AdminController::class , 'destroy'])->name('destroy');

            Route::post('resotre/{id}' , [Dashboard\AdminController::class , 'restore'])->name('restore');

            Route::resource('videos', Dashboard\VideoController::class);

            Route::resource('codes', Dashboard\CodesController::class);

           

            Route::get('/courses/{courseId}/playlists', [Dashboard\VideoController::class, 'getPlaylistsByCourse']);

            Route::get('/settings', [Dashboard\SettingController::class, 'index'])->name('settings');
            Route::post('/settings/store', [Dashboard\SettingController::class, 'store'])->name('settings.store');

        });




        require __DIR__.'../../auth.php';
});
