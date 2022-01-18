<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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


Route::domain(config('app.web_domain'))->group(function () {
    Route::get('/', function () {
        return view('frontend.index');
    })->name('frontend.index');
    Route::post('contact', [ContactController::class, 'storeContact'])
    ->name('contact.store');
});

Route::domain(config('app.cms_domain'))->group(function () {
    require __DIR__.'/auth.php';
    Route::post("/login", 'App\Http\Controllers\cms\LoginController@login')->name('login.submit');
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/', 'App\Http\Controllers\cms\HomeController@index')->name("cms.home.index");
        Route::get('/dashboard', 'App\Http\Controllers\cms\HomeController@showDashboard')->name("dashboard");
        Route::get('/change-password', [\App\Http\Controllers\cms\changePasswordController::class, 'changePassword'])->name('changePassword');
        Route::put('/change-password/{id}', [\App\Http\Controllers\cms\changePasswordController::class, 'passwordChange'])->name('cms.password.change');
        Route::get('/logout', 'App\Http\Controllers\cms\LoginController@logout')->name("logout");
    });
});

