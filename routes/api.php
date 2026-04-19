<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\RessourceController;

Route::apiResource('etudiants', EtudiantController::class);
Route::apiResource('filieres', FiliereController::class);
Route::apiResource('enseignants', EnseignantController::class);
Route::apiResource('modules', ModuleController::class);
Route::apiResource('inscriptions', InscriptionController::class);
Route::apiResource('validations', ValidationController::class);
Route::apiResource('ressources', RessourceController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
