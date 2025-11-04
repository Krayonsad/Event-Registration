<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TechRegistrationController;
use App\Http\Controllers\Starup_expoController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\GoveController;
use App\Http\Controllers\GreenController;


Route::get('/', function () {
    return view('events');
})->name('events');

Route::get('/tech-innovation', function () {
    return view('tech_innovation');
})->name('tech_innovation');

Route::get('/starup_expo', function () {
    return view('starup_expo');
})->name('starup_expo');


Route::get('/register', [TechRegistrationController::class, 'getForm'])->name('register_form');


Route::post('/register', [TechRegistrationController::class, 'postForm'])->name('tech.postForm');

Route::get('/starups_register', [Starup_expoController::class, 'view'])
     ->name('starups_register');

Route::get('/starups_expo', [Starup_expoController::class, 'starup_expo'])
     ->name('starup_expo_detail');
     Route::post('/starups_expo', [Starup_expoController::class, 'postForm'])
     ->name('starup_expo.post');



     
Route::get('/businessview', [BusinessController::class, 'view'])
     ->name('business');
  
Route::get('/goveview', [GoveController::class, 'view'])
     ->name('gove');
     

  Route::get('/greenview', [GreenController::class, 'view'])
     ->name('green');