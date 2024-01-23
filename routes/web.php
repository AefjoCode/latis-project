<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create-data-siswa', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
    Route::post('/students', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
    Route::get('/student/show/{id}', [App\Http\Controllers\StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{id}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{id}', [App\Http\Controllers\StudentController::class, 'update'])->name('student.update');

    
    Route::delete('/student/{id}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/student/export-excel', [App\Http\Controllers\StudentController::class, 'export'])->name('student.export');
    
    Route::get('/students/search',  [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');

});








