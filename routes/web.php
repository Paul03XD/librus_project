<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\UsersController::class, 'loggedin'])->name('loggedIn');

Route::get('/grades', [App\Http\Controllers\GradeController::class, 'show'])->name('grades');
Route::get('/usergrades', [App\Http\Controllers\GradeController::class, 'showuser'])->name('usergrades');

Route::get('/addGrade', [App\Http\Controllers\GradeController::class, 'showform'])->name('addGrades');
Route::post('/addGrade', [App\Http\Controllers\GradeController::class, 'add'])->name('createGrade');

Route::get('/classes', [App\Http\Controllers\ClassController::class, 'show'])->name('classes');
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
