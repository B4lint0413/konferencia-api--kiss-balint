<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/registrations', [RegistrationController::class, 'index'])->name('registrations.index');
Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])->whereNumber('registration')->name('registrations.show');
Route::get('/registrations/count', [RegistrationController::class, 'count'])->name('registrations.count');
Route::delete('/registrations/{registration}', [RegistrationController::class, 'destroy'])->name('registrations.destroy');