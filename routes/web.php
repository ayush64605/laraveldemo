<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectcategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectuserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
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

Route::get('/', [AuthController::class, 'index'])->name('index');

Route::get('/dashboard', [AuthenticatedSessionController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(AuthCheck::class)->group(function () {

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
        Route::post('save/{project}', [ProjectuserController::class, 'save'])->name('save');
        Route::get('delete/{project}', [ProjectuserController::class, 'delete'])->name('delete');
    });

    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('show/', [EmployeeController::class, 'show'])->name('show');
        Route::post('save/', [EmployeeController::class, 'save'])->name('save');
        Route::get('delete/{employee}', [EmployeeController::class, 'delete'])->name('delete');
    });

    Route::prefix('tag')->name('tag.')->group(function () {
        Route::get('show/', [TagController::class, 'show'])->name('show');
        Route::post('save/', [TagController::class, 'save'])->name('save');
        Route::get('delete/{tag}', [TagController::class, 'delete'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('show/', [UserController::class, 'show'])->name('show');
        Route::get('add/{user?}', [UserController::class, 'add'])->name('add');
        Route::post('save/{user?}', [UserController::class, 'save'])->name('save');
        Route::get('delete/{user}', [UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('employee_project')->name('employee-project.')->group(function () {
        Route::get('show/{employee}', [EmployeeProjectController::class, 'show'])->name('show');
        Route::post('save/{employee}', [EmployeeProjectController::class, 'save'])->name('save');
        Route::get('delete/{employee}/{project}', [EmployeeProjectController::class, 'delete'])->name('delete');
    });

    Route::prefix('projectcategory')->name('projectcategory.')->group(function () {
        Route::get('show', [ProjectcategoryController::class, 'show'])->name('show');
        Route::post('save', [ProjectcategoryController::class, 'save'])->name('save');
        Route::get('delete/{projectcategory}', [ProjectcategoryController::class, 'delete'])->name('delete');
    });

     Route::prefix('role')->name('role.')->group(function () {
        Route::get('show', [RoleController::class, 'show'])->name('show');
        Route::get('add/{role?}', [RoleController::class, 'add'])->name('add');
        Route::post('save/{role?}', [RoleController::class, 'save'])->name('save');
        Route::get('delete/{role}', [RoleController::class, 'delete'])->name('delete');
    });
});

Route::prefix('project/task')->name('project.task.')->group(function () {
    Route::get('show/{project}', [TaskController::class, 'show'])->name('show');
    Route::post('save/', [TaskController::class, 'save'])->name('save');
    Route::get('delete/{task}', [TaskController::class, 'delete'])->name('delete');
});

Route::prefix('comment')->name('comment.')->group(function () {
    Route::get('task/add/{post}', [CommentController::class, 'addcommenttask'])->name('task.add');
    Route::get('project/add/{post}', [CommentController::class, 'addcommentproject'])->name('project.add');
    Route::post('save/', [CommentController::class, 'save'])->name('save');
});

Route::get("/employee/login", [EmployeeController::class, "login"])->name('employee.login');
Route::post("/employee/loginprocess", [EmployeeController::class, "employeelogin"])->name("employee.loginprocess");
Route::get("/employee/logout", [EmployeeController::class, "logout"])->name("employee.logout");

Route::middleware(Employee::class)->group(function () {
    Route::prefix('employee')->name('employee.')->group(function () {
        Route::get('index', [EmployeeController::class, 'index'])->name('index');
    });
});


Route::prefix('setting')->name('setting.')->group(function () {

    Route::get('general', [SettingController::class, 'general'])->name('general');
    Route::get('theme', [SettingController::class, 'theme'])->name('theme');
    Route::get('captcha', [SettingController::class, 'captcha'])->name('captcha');
    Route::get('email', [SettingController::class, 'email'])->name('email');
    Route::get('annoucement', [SettingController::class, 'annoucement'])->name('annoucement');
    Route::post('general_save', [SettingController::class, 'general_save'])->name('general_save');
    Route::post('theme_save', [SettingController::class, 'theme_save'])->name('theme_save');
    Route::post('captcha_save', [SettingController::class, 'captcha_save'])->name('captcha_save');
    Route::post('email_save', [SettingController::class, 'email_save'])->name('email_save');
    Route::post('annoucement_save', [SettingController::class, 'annoucement_save'])->name('annoucement_save');
});

require __DIR__ . '/auth.php';
