<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\PeleaController;
use App\Http\Controllers\VeladaController;
use App\Http\Controllers\VeladaDBController;
use App\Http\Controllers\PeleaDBController;
use App\Http\Controllers\DatabaseController;


Route::view('/login', 'login')->name('login');

Route::get('/', function () {return view('index');})->name('index');


Route::get('/participantes', function () {return view('Participante.indexParticipante');})->name('participantes');
Route::get('/peleas', function () {return view('Pelea.indexPelea');})->name('peleas');
Route::get('/velada', function () {return view('Velada.indexVelada');})->name('velada');

// CRUD Pelea
Route::get('/peleas/insertar', [PeleaController::class, 'create'])->name('peleas/insertar');
Route::post('/peleas/insertar', [PeleaController::class, 'store']);
Route::get('/peleas/editar/{ID_Pelea}', [PeleaController::class, 'edit'])->name('peleas.editar');
Route::put('/peleas/{ID_Pelea}', [PeleaController::class, 'update'])->name('peleas.update');


// CRUD Velada
Route::get('/velada/insertar', [VeladaController::class, 'create'])->name('velada/insertar');
Route::post('/velada/insertar', [VeladaController::class, 'store']);
Route::get('/velada/editar/{ID_Velada}', [VeladaController::class, 'edit'])->name('velada.editar');
Route::put('/velada/{ID_Velada}', [VeladaController::class, 'update'])->name('velada.update');



