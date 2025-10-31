<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\TechRegistrationController;

Route::get('/', function () {
    return view('events');
})->name('events');

Route::get('/tech-innovation', function () {
    return view('tech_innovation');
})->name('tech_innovation');

Route::get('/register', [TechRegistrationController::class, 'getForm'])->name('register_form');
Route::post('/register', [TechRegistrationController::class, 'postForm'])->name('tech.postForm');


