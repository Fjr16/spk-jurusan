<?php

use App\Http\Controllers\CalculationController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home', [
        'title' => 'Home',
    ]);
});
Route::get('/login', function () {
    return view('pages.guest.login', [
        'title' => 'Login',
    ]);
});

// master Siswa
Route::get('student', [StudentController::class, 'index'])->name('student.index');
Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::post('student/store', [StudentController::class, 'store'])->name('student.store');
Route::delete('student/destroy/{id}', [StudentController::class, 'store'])->name('student.store');

// master Jurusan
Route::get('major', [MajorController::class, 'index'])->name('major.index');
Route::get('major/edit/{id}', [MajorController::class, 'edit'])->name('major.edit');
Route::post('major/store', [MajorController::class, 'store'])->name('major.store');
Route::delete('major/destroy/{id}', [MajorController::class, 'store'])->name('major.store');

Route::prefix('criteria')->group(function(){
    // type kriteria
    Route::get('/type', [CriteriaController::class, 'indexType'])->name('type.index');
    Route::get('/type/edit/{id}', [CriteriaController::class, 'editType'])->name('type.edit');
    Route::post('/type/store', [CriteriaController::class, 'storeType'])->name('type.store');
    Route::delete('/type/destroy/{id}', [CriteriaController::class, 'storeType'])->name('type.store');

    // kriteria
    Route::get('/index', [CriteriaController::class, 'index'])->name('criteria.index');
    Route::get('/edit/{id}', [CriteriaController::class, 'edit'])->name('criteria.edit');
    Route::post('/store', [CriteriaController::class, 'store'])->name('criteria.store');
    Route::delete('/destroy/{id}', [CriteriaController::class, 'store'])->name('criteria.store');

    // sub kriteria
    Route::get('/sub', [CriteriaController::class, 'indexSub'])->name('sub.index');
    Route::get('/sub/edit/{id}', [CriteriaController::class, 'editSub'])->name('sub.edit');
    Route::post('/sub/store', [CriteriaController::class, 'storeSub'])->name('sub.store');
    Route::delete('/sub/destroy/{id}', [CriteriaController::class, 'storeSub'])->name('sub.store');
});

Route::prefix('calculation')->group(function(){
    // calculation
    Route::get('/index', [CalculationController::class, 'index'])->name('calculation.index');
    Route::get('/edit/{id}', [CalculationController::class, 'edit'])->name('calculation.edit');
    Route::post('/store', [CalculationController::class, 'store'])->name('calculation.store');
    Route::delete('/destroy/{id}', [CalculationController::class, 'store'])->name('calculation.store');
});
