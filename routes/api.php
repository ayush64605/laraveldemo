<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\EmployeeProjectController;
use App\Http\Controllers\api\ProjectcategoryController;
use App\Http\Controllers\api\ProjectController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\ProjectuserController;
use App\Http\Controllers\api\TagController;
use App\Http\Controllers\api\TaskController;
use App\Http\Middleware\AuthCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return 'welcome';
});

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);


    Route::prefix('project')->name('project.api.')->group(function () {
        Route::get('show', [ProjectController::class, 'show']);
        Route::get('details/{id}', [ProjectController::class, 'projectDetails']);
        Route::get('task/{project}', [ProjectController::class, 'task']);
        Route::get('comments/{project}', [ProjectController::class, 'projectComments']);
        Route::get('employee/{project}', [ProjectController::class, 'projectEmployee']);
    });

    Route::prefix('employee')->name('employee.api.')->group(function () {
        Route::get('show/', [EmployeeController::class, 'show'])->name('show');
        Route::post('save/', [EmployeeController::class, 'save'])->name('save');
        Route::post('delete/{employee}', [EmployeeController::class, 'delete'])->name('delete');
    });

    Route::prefix('project/user')->name('project.user.')->group(function () {
        Route::post('save/{project}', [ProjectuserController::class, 'save'])->name('save');
        Route::get('delete/{project}', [ProjectuserController::class, 'delete'])->name('delete');
    });

    Route::prefix('tag')->name('tag.api.')->group(function () {
        Route::get('show/', [TagController::class, 'show'])->name('show');
        Route::post('save/', [TagController::class, 'save'])->name('save');
        Route::get('delete/{tag}', [TagController::class, 'delete'])->name('delete');
    });


    Route::prefix('employee_project')->name('employee-project.api.')->group(function () {
        Route::get('show/{employee}', [EmployeeProjectController::class, 'show'])->name('show');
        Route::post('save/{employee}', [EmployeeProjectController::class, 'save'])->name('save');
        Route::get('delete/{employee}/{project}', [EmployeeProjectController::class, 'delete'])->name('delete');
    });

    Route::prefix('projectcategory')->name('projectcategory.api.')->group(function () {
        Route::get('show', [ProjectcategoryController::class, 'show'])->name('show');
        Route::post('save', [ProjectcategoryController::class, 'save'])->name('save');
        Route::get('delete/{projectcategory}', [ProjectcategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('comment')->name('comment.api.')->group(function () {
        Route::post('save/', [CommentController::class, 'save'])->name('save');
    });

    Route::prefix('project/task')->name('project.task.api.')->group(function () {
        Route::get('show/{project}', [TaskController::class, 'show'])->name('show');
        Route::post('save/', [TaskController::class, 'save'])->name('save');
        Route::get('delete/{task}', [TaskController::class, 'delete'])->name('delete');
    });
});
