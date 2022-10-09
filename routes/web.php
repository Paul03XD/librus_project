<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\UsersController::class, 'loggedin'])->name('loggedIn');

Route::get('/addGrades/{name}', [App\Http\Controllers\GradeController::class, 'showform'])->name('addGrade');
Route::post('/addGrades/{name}', [App\Http\Controllers\GradeController::class, 'add'])->name('createGrade');
Route::get('/grades/{name}', [App\Http\Controllers\GradeController::class, 'show'])->name('grades');

Route::get('/assignType', [App\Http\Controllers\UsersController::class, 'showform'])->name('assignType');
Route::post('/assignType', [App\Http\Controllers\UsersController::class, 'assign'])->name('createAssignType');
Route::get('/usergrades', [App\Http\Controllers\GradeController::class, 'showuser'])->name('usergrades');

Route::get('/school', [App\Http\Controllers\ClassController::class, 'showschool'])->name('showSchool');

Route::get('/addClass', [App\Http\Controllers\ClassController::class, 'showform'])->name('addClasses');
Route::post('/addClass', [App\Http\Controllers\ClassController::class, 'add'])->name('createClass');
Route::get('/assignClass', [App\Http\Controllers\ClassController::class, 'showassignform'])->name('assignClass');
Route::post('/assignClass', [App\Http\Controllers\ClassController::class, 'assign'])->name('createAssignClass');

Route::get('/users', [App\Http\Controllers\UsersController::class, 'show'])->name('users');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'show'])->name('adminView');
Route::get('/addSub', [App\Http\Controllers\SubjectController::class, 'show'])->name('addSubjects');
Route::post('/addSub', [App\Http\Controllers\SubjectController::class, 'add'])->name('createSubject');
Route::get('/assignSub', [App\Http\Controllers\SubjectController::class, 'showassignform'])->name('assignSubject');
Route::post('/assignSub', [App\Http\Controllers\SubjectController::class, 'assign'])->name('createAssignSubject');


Route::get('/class/{name}', [App\Http\Controllers\ClassController::class, 'show'])->name('showClass');
