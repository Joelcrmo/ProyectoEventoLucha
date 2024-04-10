<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TecnicaController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\LocalizacionController;
use App\Http\Controllers\PeleaController;
use App\Http\Controllers\VeladaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ValidacionController;


Route::group(['prefix' => 'joel'], function () {
    Route::apiResource('Rol', RolController::class);
    Route::apiResource('Categoria', CategoriaController::class);
    Route::apiResource('Tecnica', TecnicaController::class);
    Route::apiResource('Pais', PaisController::class);
    Route::apiResource('Participante', ParticipanteController::class);
    Route::apiResource('Localizacion', LocalizacionController::class);
    Route::apiResource('Pelea', PeleaController::class);
    Route::apiResource('Velada', VeladaController::class);
    Route::apiResource('Usuario', UsuarioController::class);
    Route::apiResource('Validacion', ValidacionController::class);

    Route::get('Rol/{ID_Rol}', [RolController::class, 'show']);
    Route::get('Tecnica/{ID_Tecnica}', [TecnicaController::class, 'show']);
    Route::get('Pais/{ID_Pais}', [PaisController::class, 'show']);
    Route::get('Participante/{ID_Participante}', [ParticipanteController::class, 'show']);
    Route::get('Localizacion/{ID_Localizacion}', [LocalizacionController::class, 'show']);
    Route::get('Pelea/{ID_Pelea}', [PeleaController::class, 'show']);
    Route::get('Velada/{ID_Velada}', [VeladaController::class, 'show']);

    Route::get('/api/joel/Categoria', [CategoriaController::class, 'index']);
    Route::get('/api/joel/Categoria/{ID_Categoria}', [CategoriaController::class, 'show']);
    Route::get('/Categoria/{ID_Categoria}/Participantes', [CategoriaController::class, 'participantesPorCategoria']);

    Route::put('Usuario/{ID_Usuario}', [UsuarioController::class, 'show']);
    Route::put('Validacion/{ID_Validacion}', [ValidacionController::class, 'show']);

    Route::delete('Pelea/{ID_Pelea}', [PeleaController::class, 'destroy']);
    Route::delete('Velada/{ID_Velada}', [VeladaController::class, 'destroy']);

    Route::post('Pelea', [PeleaController::class, 'store']);
    Route::post('Velada', [VeladaController::class, 'store']);
    Route::post('Validacion/{ID_Usuario}', [ValidacionController::class, 'create']);




 });



