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
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SoalController;
use App\Models\SubMateri;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('landing');
});

// Public Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'create']);

Route::get('/token_quiz', function () {
     return view('quiz.token-quiz');
 });

// Siswa Routes
Route::prefix('siswa')->middleware(['role:siswa', 'auth', 'check_session'])->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/quiz', [SiswaController::class, 'quiz'])->name('siswa.quiz');
    Route::get('/join-quiz', [SiswaController::class, 'join_quiz'])->name('siswa.join-quiz');
    Route::get('/study-quiz', [SiswaController::class, 'study_quiz'])->name('siswa.study-quiz');
    Route::get('/preview-quiz', [SiswaController::class, 'preview_quiz'])->name('siswa.preview-quiz');
    Route::get('/leaderboard-quiz', [SiswaController::class, 'leaderboard_quiz'])->name('siswa.leaderboard-quiz');
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
    Route::get('/kelas/materi/{materi_id}/soal/{soalId}/show', [SoalController::class, 'showSoal'])->name('siswa.soal.show.soal');
    Route::post('/kelas/materi/{materi_id}/soal/{soalId}/store-jawaban', [SoalController::class, 'storeJawaban'])->name('siswa.soal.store.jawaban');
    Route::get('/kelas/materi/{materi_id}/soal/{soalId}/hasil-soal', [SoalController::class, 'hasilSoal'])->name('siswa.soal.hasil');
    Route::get('/kelas/materi/{materi_id}/soal/{soalId}/preview', [SoalController::class, 'previewSoal'])->name('siswa.soal.preview');
    Route::get('/kelas/{id}/materi/{materiId}/submateri/{subMateriId}/{userTypeId?}', [SubMateriController::class, 'showSubMateri'])
    ->name('siswa.sub-materi.show');
    Route::post('/kelas/{id}/materi/{materiId}/submateri/{subMateriId}/mark-as-read', [SubMateriController::class, 'markAsRead'])
    ->name('siswa.sub-materi.mark-as-read');

    Route::get('/kelas/{kelasId}/sertifikat', [KelasController::class, 'cetakSertifikat'])->name('kelas.cetakSertifikat');

    Route::get('/quiz/show', [QuizController::class, 'showQuiz'])->name('siswa.show-quiz');
    Route::post(('/quiz/join'), [QuizController::class, 'joinQuiz'])->name('siswa.join.quiz');
    Route::get('/quiz/{id}/preview', [QuizController::class, 'previewQuiz'])->name('siswa.preview.quiz');
    Route::get('/quiz/{id}/take-quiz', [QuizController::class, 'takeQuiz'])->name('siswa.take-quiz');
    Route::post('/quiz/{id}/submit-quiz', [QuizController::class, 'submitQuiz'])->name('siswa.submit-quiz');
    Route::get('/quiz/{id}/leaderboard', [QuizController::class, 'showResultQuiz'])->name('siswa.show.result');
    Route::get('quiz/latest-leaderboard', [QuizController::class, 'showLeaderboard'])->name('siswa.show.latest-leaderboard');
});

// Guru Routes
Route::prefix('guru')->middleware(['role:guru', 'auth', 'check_session'])->group(function () {
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
    Route::resource('/kelas/materi/{materi_id}/soal', SoalController::class)->names([
        'create' => 'guru.soal.create',
        'store' => 'guru.soal.store',
        'show' => 'guru.soal.show',
        'edit' => 'guru.soal.edit',
        'destroy'=> 'guru.soal.destroy',
        'update' => 'guru.soal.update',
    ])->parameters(['soal'=>'soal_id']);
    Route::get('/kelas/materi/{materi_id}/soal/{soal_id}', [SoalController::class, 'index'])->name('guru.soal.index');
    Route::post('/kelas/materi/{materi_id}/soal/{soal_id}/store-pertanyaan', [SoalController::class, 'storePertanyaan'])->name('guru.soal.store.pertanyaan');
    Route::delete('/kelas/materi/{materi_id}/soal/{soal_id}/pertanyaan/{pertanyaan_id}', [SoalController::class, 'destroyPertanyaan'])->name('guru.soal.destroy.pertanyaan');

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
    Route::delete('/sub-materi/{subMateriId}', [SubMateriController::class, 'destroySubMateri'])
    ->name('sub-materi.destroy');
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
        'create' => 'guru.result.case.create',
        'edit' => 'guru.result.case.edit',
        'destroy' => 'guru.result.case.destroy',
    ]);
    Route::get('/result/case-study/{caseStudyId}', [ResultCaseStudyController::class, 'index'])
        ->name('guru.result.case.index');
    Route::get('/result/case-study/{caseStudyId}', [ResultCaseStudyController::class, 'show'])
        ->name('guru.result.case.show');
    Route::post('/result/case-study/siswa/{id}/store', [ResultCaseStudyController::class, 'store'])
        ->name('guru.result.case.store');
    Route::put('/result/case-study/siswa/{id}/update', [ResultCaseStudyController::class, 'update'])
        ->name('guru.result.case.update');
    Route::get('/result/case-study/{caseStudyId}/siswa/{id}', [ResultCaseStudyController::class, 'showSubmission'])
        ->name('guru.result.case.showSubmission');
    Route::get('/compiler', [GuruController::class, 'compiler'])->name('guru.compiler');
    Route::get('/quiz', [GuruController::class, 'quiz'])->name('guru.quiz');
    Route::get('/quiz/tambah-quiz', [QuizController::class, 'index'])->name('guru.tambah-quiz');
    Route::get('/quiz/{id}/detail-quiz', [QuizController::class, 'show'])->name('guru.detail-quiz');
    Route::post(('/quiz/{id}/detail-quiz/store'), [QuizController::class, 'CreateQuestion'])->name('guru.question.store');
    Route::post('/quiz/store', [QuizController::class, 'store'])->name('guru.quiz.store');
    Route::put('/quiz/{id}/detail-quiz/{questionId}/update', [QuizController::class, 'updateQuestion'])->name('guru.question.update');
    Route::delete('/quiz/{id}/detail-quiz/{questionId}/delete', [QuizController::class, 'destroyQuestion'])->name('guru.question.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware(['role:admin', 'auth', 'check_session'])->group(function () {
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

// Menampilkan form untuk membuat quiz
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quiz.create');

// Menyimpan quiz

// Menampilkan quiz berdasarkan token
Route::get('/quiz/{token}', [QuizController::class, 'showByToken'])->name('quiz.showByToken');

// Mengirim jawaban quiz
Route::post('/quiz/{token}/submit', [QuizController::class, 'submitQuiz'])->name('quiz.submit');
