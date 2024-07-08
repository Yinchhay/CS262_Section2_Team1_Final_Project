<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//http://127.0.0.1:8000/api/register
Route::post('/register', [ApiController::class, 'register']);
//http://127.0.0.1:8000/api/login
Route::post('/login', [ApiController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', function (Request $request) {
        return $request->user();
    });
    //http://127.0.0.1:8000/api/store
    //Function to store everthing include Poster, Question, Test{Testskill}
    Route::post('/store', [ApiController::class, 'store']);

    //http://127.0.0.1:8000/api/getPosters
    // Functions to retrieve Posters from database
    Route::get('getPosters', [ApiController::class, 'getPosters']);

    //http://127.0.0.1:8000/api/posters/{id}
    //Function to delete poster
    Route::delete('posters/{id}', [ApiController::class, 'deletePoster']);

    //http://127.0.0.1:8000/api/getQuestions
    //Fcuntion to retrieve all questions from database
    Route::get('getQuestions', [ApiController::class, 'getQuestions']);

    //http://127.0.0.1:8000/api/questions/{id}
    //Function to delete questions
    Route::delete('questions/{id}', [ApiController::class, 'deleteQuestion']);

    //http://127.0.0.1:8000/api/getTests
    //Function to retrieve all the Tests from database
    Route::get('getTests', [ApiController::class, 'getTests']);

    //http://127.0.0.1:8000/api/gettest/{id}
  Route::get('gettest/{id}', [ApiController::class, 'getTestById']);
  
    //http://127.0.0.1:8000/api/tests/{id}
    //Function to delete test
    Route::delete('tests/{id}', [ApiController::class, 'deleteTest']);

    //http://127.0.0.1:8000/api/getTestSkills
    //Functions to retrieve all the Test skills from database
    Route::get('getTestSkills', [ApiController::class, 'getTestSkills']);

    //http://127.0.0.1:8000/api/addSkill
    // function to add skill
    Route::post('addSkill', [ApiController::class, 'addSkill']);

    //http://127.0.0.1:8000/api/getSkills
    //Functions to retrieve all the skills from database
    Route::get('/getSkills', [ApiController::class, 'getSkills']);

    //http://127.0.0.1:8000/api/skills/{id}
    //Function to delete skill
    Route::delete('skills/{id}', [ApiController::class, 'deleteSkill']);

    //http://127.0.0.1:8000/api/question-types
    //Function to retrieve all the Question type from database
    Route::get('getQuestionTypes', [ApiController::class, 'getQuestionTypes']);

    //http://127.0.0.1:8000/api/update/{id}
    Route::put('update/{id}', [ApiController::class, 'update']);

    //http://127.0.0.1:8000/api/delete/{id}
    Route::delete('delete/{id}', [ApiController::class, 'delete']);
    
    //http://127.0.0.1:8000/api/users
    Route::get('getusers', [ApiController::class, 'getAllUsers']);

    //http://127.0.0.1:8000/api/logout
    Route::get('logout', [ApiController::class, 'logout']);

    Route::post('user-answers', [ApiController::class, 'saveUserAnswer']);

    

});

// Route::get('/users', function (Request $request) {
//     return $request->user();
// });
// //http://127.0.0.1:8000/api/store
// //Function to store everthing include Poster, Question, Test{Testskill}
// Route::post('/store', [ApiController::class, 'store']);

// //http://127.0.0.1:8000/api/getPosters
// // Functions to retrieve Posters from database
// Route::get('getPosters', [ApiController::class, 'getPosters']);

// //http://127.0.0.1:8000/api/posters/{id}
// //Function to delete poster
// Route::delete('posters/{id}', [ApiController::class, 'deletePoster']);

// //http://127.0.0.1:8000/api/getQuestions
// //Fcuntion to retrieve all questions from database
// Route::get('getQuestions', [ApiController::class, 'getQuestions']);

// //http://127.0.0.1:8000/api/questions/{id}
// //Function to delete questions
// Route::delete('questions/{id}', [ApiController::class, 'deleteQuestion']);

// //http://127.0.0.1:8000/api/getTests
// //Function to retrieve all the Tests from database
// Route::get('getTests', [ApiController::class, 'getTests']);

// //http://127.0.0.1:8000/api/gettest/{id}
// Route::get('gettest/{id}', [ApiController::class, 'getTestById']);

// Route::post('user-answers', [ApiController::class, 'saveUserAnswer']);


// //http://127.0.0.1:8000/api/tests/{id}
// //Function to delete test
// Route::delete('tests/{id}', [ApiController::class, 'deleteTest']);

// //http://127.0.0.1:8000/api/getTestSkills
// //Functions to retrieve all the Test skills from database
// Route::get('getTestSkills', [ApiController::class, 'getTestSkills']);

// //http://127.0.0.1:8000/api/addSkill
// // function to add skill
// Route::post('addSkill', [ApiController::class, 'addSkill']);

// //http://127.0.0.1:8000/api/getSkills
// //Functions to retrieve all the skills from database
// Route::get('/getSkills', [ApiController::class, 'getSkills']);

// //http://127.0.0.1:8000/api/skills/{id}
// //Function to delete skill
// Route::delete('skills/{id}', [ApiController::class, 'deleteSkill']);

// //http://127.0.0.1:8000/api/question-types
// //Function to retrieve all the Question type from database
// Route::get('getQuestionTypes', [ApiController::class, 'getQuestionTypes']);

// //http://127.0.0.1:8000/api/update/{id}
// Route::put('update/{id}', [ApiController::class, 'update']);

// //http://127.0.0.1:8000/api/delete/{id}
// Route::delete('delete/{id}', [ApiController::class, 'delete']);

// //http://127.0.0.1:8000/api/users
// Route::get('getusers', [ApiController::class, 'getAllUsers']);

// //http://127.0.0.1:8000/api/logout
// Route::get('logout', [ApiController::class, 'logout']);

