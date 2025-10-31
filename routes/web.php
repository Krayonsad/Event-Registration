<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TechRegistrationController;
use App\Http\Controllers\Starup_expoController;


Route::get('/', function () {
    return view('events');
})->name('events');

Route::get('/tech-innovation', function () {
    return view('tech_innovation');
})->name('tech_innovation');




Route::get('/register', [TechRegistrationController::class, 'getForm'])->name('register_form');
// Route::get('/starups_expo', [Starup_expoController::class, 'starup_expo'])->name('starup_expo');

Route::post('/register', [TechRegistrationController::class, 'postForm'])->name('tech.postForm');

Route::get('/starups_expoview', [Starup_expoController::class, 'view'])
     ->name('starup_expo');

Route::get('/starups_expo', [Starup_expoController::class, 'starup_expo'])
     ->name('starup_expo_detail');
     Route::post('/starups_expo', [Starup_expoController::class, 'postForm'])
     ->name('starup_expo.post');