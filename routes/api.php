<?php

use App\Http\Controllers\ApiController;
use Iluminate\Support\Facades\Routes;

Route::get('/status',[ApiController::class, 'status']);
Route::get('/clients',[ApiController::class, 'clients']);
Route::get('/client-by-id/{id}', [ApiController::class, 'clientById']);