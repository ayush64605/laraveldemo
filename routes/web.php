<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

//////////////// Auth //////////////////
Route::get("/", [AuthController::class, "login"])->name('login');
Route::post("/loginprocess", [AuthController::class, "loginprocess"])->name("loginprocess");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware(AuthCheck::class)->group(function () {

    Route::get('/index', [ProjectController::class, 'index'])->name('index');

    Route::prefix('project')->name('project.')->group(function () {
        Route::get('show', [ProjectController::class, 'projects'])->name('show');
        Route::get('add', [ProjectController::class, 'projectadd'])->name('add');
        Route::post('save', [ProjectController::class, 'saveProject'])->name('save');
        Route::get('update/{project}', [ProjectController::class, 'projectupdate'])->name('update');
        Route::get('delete/{project}', [ProjectController::class, 'projectdelete'])->name('delete');
        Route::get('details/{project}', [ProjectController::class, 'projectdetails'])->name('details');
    });

});

