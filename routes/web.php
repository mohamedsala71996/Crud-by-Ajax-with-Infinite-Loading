<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MoController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('comments.comments');
// });



Route::get('/', [CommentController::class, 'index']);
Route::get('/show', [CommentController::class, 'show']);
Route::post('/store', [CommentController::class, 'store']);
Route::put('/update', [CommentController::class, 'update']);
Route::delete('/destroy', [CommentController::class, 'destroy']);

