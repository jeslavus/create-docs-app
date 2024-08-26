<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\DB;

Route::post('/generate-document', [DocumentController::class, 'generate']);

// Route::get('/', function () {
//     return view('welcome');
// });