<?php

use App\Http\Controllers\ApiGatewayController;
use Illuminate\Support\Facades\Route;

Route::get('service1', [ApiGatewayController::class, 'service1']);

Route::middleware(['jwt_auth'])->group(function () {
    Route::get('service2', [ApiGatewayController::class, 'service2']);//->middleware('jwt_auth');
});