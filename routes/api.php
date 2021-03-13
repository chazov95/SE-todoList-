<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/addTask', [TaskController::class, 'create']);

Route::delete('/task/{task}',[TaskController::class, 'delete']);
