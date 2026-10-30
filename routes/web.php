<?php

use App\Http\Controllers\InterestRegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/interest-registrations', [InterestRegistrationController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('interest-registrations.store');
