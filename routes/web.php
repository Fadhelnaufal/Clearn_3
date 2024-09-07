<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
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
Route::get('/dashboard_guru', function () {
    return view('guru.dashboard_guru');
});
Route::get('/course_guru', function () {
    return view('guru.course_guru');
});
Route::get('/livecode_guru', function () {
    return view('guru.livecode_guru');
});
Route::get('/tambah_materi', function () {
    return view('guru.tambah_materi');
});
Route::get('/tambah_studi_kasus', function () {
    return view('guru.tambah_studi_kasus');
});
Route::get('/list_question', function () {
    return view('guru.list_question');
});
Route::get('/discussion', function () {
    return view('discussion');
});
Route::get('/course_detail_guru', function () {
    return view('guru.course_detail_guru');
});
Route::get('/card', function () {
    return view('component-cards-basic');
});
Route::get('/component-carousels', function () {
    return view('component-carousels');
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
Route::get('/icon', function () {
    return view('icons-boxicons');
});
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/register',[RegisterController::class,'create']);

Route::group(['middleware' => ['role:siswa']], function(){
    Route::get('siswa/dashboard',[SiswaController::class,'index']);
    Route::post('/dashboard',[DashboardController::class,'storeAnswers'])->name('store.answers');
    Route::get('course', [KelasController::class, 'index'])->name('kelas.index');
});
Route::group(['middleware' => ['role:guru']], function(){
    Route::get('guru/dashboard',[GuruController::class,'index']);
});
Route::group(['middleware' => ['role:admin']], function(){
    Route::get('admin/dashboard',[AdminController::class,'index']);
});




    Route::post('/logout',function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');

// require __DIR__ . '/auth.php';
