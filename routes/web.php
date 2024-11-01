<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
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
    return view('welcome');
});

/*
Route::get('/aluno', [AlunoController::class,'index'])
    ->name('aluno.form');
*/
Route::post('aluno/search',
    [AlunoController::class,'search'])
    ->name('aluno.search');
Route::resource('aluno',
    AlunoController::class);

Route::post('curso/search',
    [CursoController::class,'search'])
    ->name('curso.search');
Route::resource('curso',
CursoController::class);







