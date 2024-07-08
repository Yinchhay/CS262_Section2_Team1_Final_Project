<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store']);

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('materials')->name('materials.')->group(function () {
    Route::resource('posters', PosterController::class);
    Route::resource('posters.tests', TestController::class);
    Route::resource('posters.tests.questions', QuestionController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::prefix('online-tests')->name('online-tests.')->group(function () {
    Route::resource('posters', PosterController::class);
    Route::resource('posters.tests', TestController::class);
    Route::resource('posters.tests.questions', QuestionController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::resource('materials', MaterialController::class);

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');

Route::get('/schedule/display', [ScheduleController::class, 'display'])->name('schedule.display');

Route::get('/tests', [TestController::class, 'index'])->name('test.index');

Route::get('/tests/create', [TestController::class, 'create'])->name('test.create');

Route::get('/user-management', [UserController::class, 'manage'])->name('user.manage');

Route::get('/user-management/profile', [UserController::class, 'profile'])->name('user.profile');

Route::get('/user-management/activities', [UserController::class, 'activity'])->name('user.activity');

Route::get('/user-management/activities/display', [UserController::class, 'display'])->name('user.display');

Route::get('/user-management/certificate', [UserController::class, 'certificate'])->name('user.certificate');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('users/{user}/profile', [UserController::class, 'profile'])->name('users.profile');

Route::get('users/{user}/activities', [UserController::class, 'activities'])->name('users.activities');

Route::get('users/{user}/activities/{prefix}/posters/{poster}', [UserController::class, 'activitiesShow'])->name('users.activities-show');

Route::get('users/{user}/certificates', [UserController::class, 'certificates'])->name('users.certificates');

Route::get('users/{user}/certificates/{certificate}/show', [UserController::class, 'certificatesShow'])->name('users.certificates-show');

Route::get('suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');

Route::get('suggestions/{suggestion}', [SuggestionController::class, 'show'])->name('suggestions.show');
