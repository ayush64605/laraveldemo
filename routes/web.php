<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeProjectController;
use App\Http\Controllers\ProjectcategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectuserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\Employee;
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
        Route::get('assignemployee/{project}', [ProjectController::class, 'assignemployee'])->name('assignemployee');
    });


    Route::prefix('project/user')->name('project.user.')->group(function () {
        Route::get('add/{project}', [ProjectuserController::class, 'add'])->name('add');
        Route::post('save/{project}', [ProjectuserController::class, 'save'])->name('save');
        Route::get('delete/{project}', [ProjectuserController::class, 'delete'])->name('delete');
    });



    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('show/', [EmployeeController::class, 'show'])->name('show');
        Route::get('add/', [EmployeeController::class, 'add'])->name('add');
        Route::post('save/', [EmployeeController::class, 'save'])->name('save');
        Route::get('update/{employee}', [EmployeeController::class, 'update'])->name('update');
        Route::get('delete/{employee}', [EmployeeController::class, 'delete'])->name('delete');
    });

    Route::prefix('tag')->name('tag.')->group(function () {
        Route::get('show/', [TagController::class, 'show'])->name('show');
        Route::get('add/', [TagController::class, 'add'])->name('add');
        Route::post('save/', [TagController::class, 'save'])->name('save');
        Route::get('delete/{tag}', [TagController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('show/', [UserController::class, 'show'])->name('show');
        Route::get('add/', [UserController::class, 'add'])->name('add');
        Route::post('save/', [UserController::class, 'save'])->name('save');
        Route::get('update/{user}', [UserController::class, 'update'])->name('update');
        Route::get('delete/{user}', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('employee_project')->name('employee-project.')->group(function () {
        Route::get('show/{employee}', [EmployeeProjectController::class, 'show'])->name('show');
        Route::get('add/{employee}', [EmployeeProjectController::class, 'add'])->name('add');
        Route::post('save/{employee}', [EmployeeProjectController::class, 'save'])->name('save');
        Route::get('delete/{employee}/{project}', [EmployeeProjectController::class, 'delete'])->name('delete');
    });

    Route::prefix('projectcategory')->name('projectcategory.')->group(function () {
        Route::get('show', [ProjectcategoryController::class, 'show'])->name('show');
        Route::get('add', [ProjectcategoryController::class, 'add'])->name('add');
        Route::post('save', [ProjectcategoryController::class, 'save'])->name('save');
        Route::get('update/{projectcategory}', [ProjectcategoryController::class, 'update'])->name('update');
        Route::get('delete/{projectcategory}', [ProjectcategoryController::class, 'delete'])->name('delete');
    });
});

Route::prefix('project/task')->name('project.task.')->group(function () {
    Route::get('show/{project}', [TaskController::class, 'show'])->name('show');
    Route::get('add/{project}', [TaskController::class, 'add'])->name('add');
    Route::post('save/', [TaskController::class, 'save'])->name('save');
    Route::get('update/{task}', [TaskController::class, 'update'])->name('update');
    Route::get('delete/{task}', [TaskController::class, 'delete'])->name('delete');
});

Route::prefix('comment')->name('comment.')->group(function () {
    Route::get('show/{post}', [CommentController::class, 'show'])->name('show');
    Route::get('/task/show/{post}', [CommentController::class, 'taskcommnetshow'])->name('task.show');
    Route::get('task/add/{post}', [CommentController::class, 'addcommenttask'])->name('task.add');
    Route::get('project/add/{post}', [CommentController::class, 'addcommentproject'])->name('project.add');
    Route::post('save/', [CommentController::class, 'save'])->name('save');
    Route::get('update/{post}', [CommentController::class, 'update'])->name('update');
    Route::get('delete/{post}', [CommentController::class, 'delete'])->name('delete');
});

Route::get("/employee/login", [EmployeeController::class, "login"])->name('employee.login');
Route::post("/employee/loginprocess", [EmployeeController::class, "employeelogin"])->name("employee.loginprocess");
Route::get("/employee/logout", [EmployeeController::class, "logout"])->name("employee.logout");

Route::middleware(Employee::class)->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('index', [EmployeeController::class, 'index'])->name('index');
    });
});

