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
    Route::get('/projectadd', [ProjectController::class, 'projectadd'])->name('projectadd');
    Route::post('/projectsave', [ProjectController::class, 'projectsave'])->name('projectsave');
    Route::get('/projectupdate/{project}', [ProjectController::class, 'projectupdate'])->name('projectupdate');
    Route::post('/projectedit/{project}', [ProjectController::class, 'projectedit'])->name('projectedit');
    Route::get('/projectupdate/{project}', [ProjectController::class, 'projectupdate'])->name('projectupdate');
    Route::get('/projectdelete/{project}', [ProjectController::class, 'projectdelete'])->name('projectdelete');
    Route::get('/projectdetails/{project}', [ProjectController::class, 'projectdetails'])->name('projectdetails');
});
