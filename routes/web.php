<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaseStudiesController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SettingRoleController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\StudentSubmissionController;
use App\Http\Controllers\SubMateriController;
use App\Http\Controllers\ResultCaseStudyController;
use App\Models\SubMateri;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('landing');
});
Route::get('/soal', function () {
    return view('siswa.soal');
});
// Route::get('/tabel', function () {
//     return view('table-datatable');
// });
// Route::get('/course_detail', function () {
//     return view('course_detail');
// });
// Route::get('/dashboard_guru', function () {
//     return view('guru.dashboard_guru');
// });
// Route::get('/course_guru', function () {
//     return view('guru.course_guru');
// });
// Route::get('/livecode_guru', function () {
//     return view('guru.livecode_guru');
// });
// Route::get('/tambah_materi', function () {
//     return view('guru.tambah_materi');
// });
// Route::get('/tambah_studi_kasus', function () {
//     return view('guru.tambah_studi_kasus');
// });
// Route::get('/list_question', function () {
//     return view('guru.list_question');
// });
// Route::get('/discussion', function () {
//     return view('discussion');
// });
// Route::get('/course_detail_guru', function () {
//     return view('guru.course_detail_guru');
// });
// Route::get('/card', function () {
//     return view('component-cards-basic');
// });
// Route::get('/component-carousels', function () {
//     return view('component-carousels');
// });
Route::get('/charts-chartjs', function () {
    return view('charts-chartjs');
});
// Route::get('/live_code', function () {
//     return view('livecode');
// });
// Route::get('/component-navs-tabs', function () {
//     return view('component-navs-tabs');
// });
// Route::get('/component-accordions', function () {
//     return view('component-accordions');
// });
// Route::get('/widget', function () {
//     return view('widgets-data');
// });
// Route::get('/icon', function () {
//     return view('icons-boxicons');
// });

// Public Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'create']);
Route::get('/quizku', function () {
     return view('quiz.quiz');
 });
Route::get('/token_quiz', function () {
     return view('quiz.token-quiz');
 });

// Siswa Routes
Route::prefix('siswa')->middleware(['role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/compiler', [SiswaController::class, 'compiler'])->name('/siswa/compiler');
    Route::post('/store-answers', [SiswaController::class, 'storeAnswers'])->name('siswa.store.answers');
    Route::get('/user-type-result', [SiswaController::class, 'getUserTypeResult'])->name('siswa.result');
    Route::post('/save-user-type', [SiswaController::class, 'saveUserType'])->name('siswa.saveUserType');
    Route::get('/course', [KelasController::class, 'index'])->name('siswa.course.index');
    Route::get('/course/{id}', [KelasController::class, 'show'])->name('siswa.course.show');
    Route::post('/course/join', [KelasController::class, 'join'])->name('siswa.course.join');
    Route::post('/course/{id}/leave', [KelasController::class, 'destroyJoin'])->name('siswa.course.leave');
    Route::resource('/course-detail', MateriController::class)->only(['index', 'show'])->names([
        'index' => 'siswa.course-detail.index',
        'show' => 'siswa.course-detail.show',
        'leave' => 'siswa.course-detail.leave',
    ]);
    Route::resource('/case-submission', StudentSubmissionController::class)->parameters([
        'case-submission' => 'id'
    ])->names([
        'index' => 'siswa.case-submission.index',
        'show'=> 'siswa.case-submission.show',
        'create' => 'siswa.case-submission.create',
        'store' => 'siswa.case-submission.store',
        'update' => 'siswa.case-submission.update',
    ]);
    Route::get('/kelas/{id}/materi/{materiId}/submateri/{subMateriId}/{userTypeId?}', [SubMateriController::class, 'showSubMateri'])
    ->name('siswa.sub-materi.show');
    Route::post('/kelas/{id}/materi/{materiId}/submateri/{subMateriId}/mark-as-read', [SubMateriController::class, 'markAsRead'])
    ->name('siswa.sub-materi.mark-as-read');

    Route::get('/kelas/{kelasId}/sertifikat', [KelasController::class, 'cetakSertifikat'])->name('kelas.cetakSertifikat');
});

// Guru Routes
Route::prefix('guru')->middleware(['role:guru'])->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::resource('/course', KelasController::class)->parameters([
        'course'=> 'id'
    ]);
    Route::post('/course/create-sertifikat', [KelasController::class, 'storeSertifikat'])->name('guru.course.store-sertifikat');
    Route::post('/kelas/materi/{materi}/siswa/{userSiswaId}/destroyJoin', [KelasController::class, 'destroyJoinStudent'])->name('guru.course-detail.destroyJoinStudent');
    Route::resource('/kelas/materi', MateriController::class)->names([
        'index' => 'guru.course-detail.index',
        'create' => 'guru.course-detail.create',
        'store' => 'guru.course-detail.store',
        'show' => 'guru.course-detail.show',
        'edit' => 'guru.course-detail.edit',
        'update' => 'guru.course-detail.update',
        'destroy' => 'guru.course-detail.destroy',
    ]);
    Route::get('/kelas/{id}/materi/{materiId}/submateri/{subMateriId}/{userTypeId?}', [SubMateriController::class, 'showSubMateri'])
    ->name('sub-materi.show');
    Route::get('/kelas/{kelasId}/sub-materi/create/{materiId}', [SubMateriController::class, 'createSubMateri'])
    ->name('sub-materi.create');
    Route::post('/kelas/{kelasId}/sub-materi/store/{userTypeId}', [SubMateriController::class, 'storeSubMateri'])
    ->name('sub-materi.store');
    Route::get('/kelas/{kelasId}/materi/{materiId}/submateri/{subMateriId}/edit/{userTypeId}', [SubMateriController::class, 'editSubMateri'])
    ->name('sub-materi.edit');
    Route::put('/kelas/{kelasId}/sub-materi/update/{userTypeId}', [SubMateriController::class, 'updateSubMateri'])
    ->name('sub-materi.update');
    Route::get('/ckeditor', [CkeditorController::class, 'index']);
    Route::post('/upload', [CkeditorController::class, 'upload'])
    ->name('ckeditor.upload');

    Route::resource('/kelas/case', CaseStudiesController::class)->names([
        'index' => 'guru.course-detail.case.index',
        'create' => 'guru.course-detail.case.create',
        'store' => 'guru.course-detail.case.store',
        'show' => 'guru.course-detail.case.show',
        'edit' => 'guru.course-detail.case.edit',
        'update' => 'guru.course-detail.case.update',
        'destroy' => 'guru.course-detail.case.destroy',
    ]);

    Route::resource('/result/case-study', ResultCaseStudyController::class)->names([
        'index' => 'guru.result.case.index',
        'create' => 'guru.result.case.create',
        'show' => 'guru.result.case.show',
        'edit' => 'guru.result.case.edit',
        'destroy' => 'guru.result.case.destroy',
    ]);
    Route::post('/result/case-study/siswa/{id}/store', [ResultCaseStudyController::class, 'store'])
        ->name('guru.result.case.store');
    Route::put('/result/case-study/siswa/{id}/update', [ResultCaseStudyController::class, 'update'])
        ->name('guru.result.case.update');
    Route::get('/result/case-study/{caseStudyId}/siswa/{id}', [ResultCaseStudyController::class, 'showSubmission'])
        ->name('guru.result.case.showSubmission');
    Route::get('/compiler', [GuruController::class, 'compiler'])->name('guru.compiler');
});

// Admin Routes
Route::prefix('admin')->middleware(['role:admin'])->group(function () {
    Route::resource('/dashboard', AdminController::class)->names([
        'index' => 'admin.dashboard',
    ]);
    Route::resource('/setting-role', SettingRoleController::class);
});

// Logout Route
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// require __DIR__ . '/auth.php';
