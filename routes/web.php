<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectcategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectuserController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

//////////////// Auth //////////////////
Route::get("/", [AuthController::class, "login"])->name('login');
Route::get("/register", [AuthController::class, "register"])->name('register');
Route::post("/loginprocess", [AuthController::class, "loginprocess"])->name("loginprocess");
Route::post("/registerprocess", [AuthController::class, "registerprocess"])->name("registerprocess");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware(AuthCheck::class)->group(function () {

    Route::get('/index', [ProjectController::class, 'index'])->name('index');

    Route::prefix('project')->name('project.')->group(function () {
        Route::get('show', [ProjectController::class, 'show'])->name('show');
        Route::get('add', [ProjectController::class, 'add'])->name('add');
        Route::post('save', [ProjectController::class, 'save'])->name('save');
        Route::get('update/{project}', [ProjectController::class, 'update'])->name('update');
        Route::get('delete/{project}', [ProjectController::class, 'delete'])->name('delete');
        Route::get('details/{project}', [ProjectController::class, 'details'])->name('details');
    });


    Route::prefix('project/user')->name('project.user.')->group(function () {
        Route::get('add/{project}', [ProjectuserController::class, 'add'])->name('add');
        Route::post('save/{project}', [ProjectuserController::class, 'save'])->name('save');
        Route::get('delete/{project}', [ProjectuserController::class, 'delete'])->name('delete');
    });

    Route::prefix('project/task')->name('project.task.')->group(function () {
        Route::get('show/{project}', [TaskController::class, 'show'])->name('show');
        Route::get('add/{project}', [TaskController::class, 'add'])->name('add');
        Route::post('save/', [TaskController::class, 'save'])->name('save');
        Route::get('delete/{task}', [TaskController::class, 'delete'])->name('delete');
    });



    Route::prefix('projectcategory')->name('projectcategory.')->group(function () {
        Route::get('show', [ProjectcategoryController::class, 'show'])->name('show');
        Route::get('add', [ProjectcategoryController::class, 'add'])->name('add');
        Route::post('save', [ProjectcategoryController::class, 'save'])->name('save');
        Route::get('update/{projectcategory}', [ProjectcategoryController::class, 'update'])->name('update');
        Route::get('delete/{projectcategory}', [ProjectcategoryController::class, 'delete'])->name('delete');
    });
});

