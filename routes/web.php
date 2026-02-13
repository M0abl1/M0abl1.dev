<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurriculoController;

Route::get('/', [CurriculoController::class, 'index']);