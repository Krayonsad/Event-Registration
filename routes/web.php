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


Route::get('/business', function () {
    return view('business');
})->name('business');

Route::get('/gove', function () {
    return view('gove');
})->name('gove');


Route::get('/register', [TechRegistrationController::class, 'getForm'])->name('register_form');


Route::post('/register', [TechRegistrationController::class, 'postForm'])->name('tech.postForm');

Route::get('/starups_register', [Starup_expoController::class, 'view'])
     ->name('starups_register');

Route::get('/starups_expo', [Starup_expoController::class, 'starup_expo'])
     ->name('starup_expo_detail');
     Route::post('/starups_expo', [Starup_expoController::class, 'postForm'])
     ->name('starup_expo.post');



     
Route::get('/business_register', [BusinessController::class, 'view'])
     ->name('business_register');
  
Route::get('/gove_business', [GoveController::class, 'view'])
     ->name('gove_business');
     

  Route::get('/greenview', [GreenController::class, 'view'])
     ->name('green');