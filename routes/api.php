<?php

use App\Http\Controllers\CepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/cep/{cep}', [CepController::class, 'search']);
