<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\CertificateController;

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

Route::get('/img', [ImageController::class, 'img'])->name('images.show');

Route::get('/', function () {
    return view('index');
});

Route::get('/signup', [UserController::class, 'signup'])->name('signup');

Route::post('/signup', [UserController::class, 'store'])->name('store'); // incorrect signup

Route::get('/login', [UserController::class, 'login'])->name('login');

Route::post('/login', [UserController::class, 'authenticate']);

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');

    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::post('/user/profile/edit', [UserController::class, 'update'])->name('user.update');
});

//Suggestion Page
Route::get('/suggestion', [SuggestionController::class, 'index'])->name('suggestion.index');

Route::post('/suggestion', [SuggestionController::class, 'store'])->name('suggestion.store');

//Score Board Page
Route::get('/scoreboard', [ScoreboardController::class, 'index'])->name('scoreboard.index');

//Certificate Page
Route::get('/certificate', [CertificateController::class, 'index'])->name('certificate.index');

Route::get('/certificate/download/{certificate}', [CertificateController::class, 'download'])->name('certificate.download');



//Material Page
Route::get('/material', [MaterialController::class, 'index'])->name('material.index');

Route::get('/material/{poster}/select', [MaterialController::class, 'select'])->name('material.select');

Route::get('/material/{testSkill}/form', [MaterialController::class, 'testSkillForm'])->name('material.testSkill.form');

Route::get('/material/{test}/form', [MaterialController::class, 'testform'])->name('material.test.form');

Route::post('/material/{testSkill}/form', [MaterialController::class, 'store'])->name('material.store');

Route::get('/material/{poster}/{testSkill}/result', [MaterialController::class, 'result'])->name('material.result');


//Online Test Page
Route::get('/online-test', [TestController::class, 'index'])->name('test.index');

Route::get('/online-test/{poster}/select', [TestController::class, 'select'])->name('test.select');

Route::get('/online-test/{testSkill}/form', [TestController::class, 'testSkillForm'])->name('test.testSkill.form');

Route::get('/online-test/{test}/form', [TestController::class, 'testform'])->name('test.form');

Route::post('/online-test/{testSkill}/form', [TestController::class, 'store'])->name('test.store');

Route::get('/online-test/{poster}/{testSkill}/result', [TestController::class, 'result'])->name('test.result');



