<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/',[ProjectController::class,'index'])->name('index');
Route::get('/projectdetails/{project}',[ProjectController::class,'projectdetails'])->name('projectdetails');
