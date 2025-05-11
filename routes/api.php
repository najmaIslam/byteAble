<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('throttle:login')->post('/login', [AuthController::class, 'login']);
Route::get('/students', [StudentController::class, 'fetchAllRecords']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/students', [StudentController::class, 'fetchAllRecords']);
    Route::get('/students/name/{name}', [StudentController::class, 'show'])->middleware('permission:show data');  // Get by name
    Route::put('/students/{id}', [StudentController::class, 'update']);       // Update
    Route::delete('/students/{id}', [StudentController::class, 'delete']);   // Delete
    Route::get('/users', [StudentController::class, 'fetchAllRecords']);
    Route::get('/users/name/{name}', [StudentController::class, 'show']);  // Get by name
    Route::middleware('role:admin')->group(function () {
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    });

    // Route::put('/users/{id}', [StudentController::class, 'update']);       // Update
    Route::delete('/users/{id}', [StudentController::class, 'delete']);   // Delete
    Route::post('/logout', [AuthController::class, 'logout']); // logout


});

Route::get('/logs/show', [LogController::class, 'showLogs'])->name('logs.show'); // show log




// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

// });