<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('landing');
});
Route::get('/course', function () {
    return view('course');
});
Route::get('/course_detail', function () {
    return view('course_detail');
});
Route::get('/charts-chartjs', function () {
    return view('charts-chartjs');
});
Route::get('/live_code', function () {
    return view('livecode');
});
Route::get('/component-navs-tabs', function () {
    return view('component-navs-tabs');
});
Route::get('/component-accordions', function () {
    return view('component-accordions');
});
Route::get('/widget', function () {
    return view('widgets-data');
});
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/register',[RegisterController::class,'create']);
Route::middleware('auth')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'show']);
    Route::post('/dashboard',[DashboardController::class,'storeAnswers'])->name('store.answers');
    // Route::get('/course');
    Route::post('/logout',function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});


// require __DIR__ . '/auth.php';
