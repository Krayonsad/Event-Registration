<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Events\LoginNotification;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\LobbyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
});

// Static Pages
Route::get('/terms-and-conditions', [StaticPagesController::class, 'termsAndConditions'])->name('terms');
Route::get('/privacy-policy', [StaticPagesController::class, 'privacyPolicy'])->name('privacy');
Route::get('/refund-and-cancellation', [StaticPagesController::class, 'refundAndCancellationPolicy'])->name('refund');
Route::get('/pricing-structure', [StaticPagesController::class, 'pricingStructure'])->name('pricing');
Route::get('/poster', [StaticPagesController::class, 'poster'])->name('poster');
Route::get('/watchlive', [StaticPagesController::class, 'live'])->name('live');
Route::get('/new_register', [UserController::class, 'registrationnew'])->name('new_register');

// UserController Routes
Route::post('/register-user', [UserController::class, 'registerUser']);
Route::get('/payment/{id}', [UserController::class, 'payment_data']);

Route::get('/feed_back', [UserController::class, 'feedback']);
Route::post('/feed_back', [UserController::class, 'feed_back']);
Route::any('/payment_data/{id}', [UserController::class, 'payment_data']);
Route::any('/payment_data_exhibitor/{id}', [UserController::class, 'payment_data_exhibitor']);
Route::match(['get', 'post'], '/import', [UserController::class, 'import']);
Route::match(['get', 'post'], '/sendTestMail', [UserController::class, 'sendTestMail']);
Route::match(['get', 'post'], '/bulkmail', [UserController::class, 'bulkmail']);
Route::match(['get', 'post'], '/bulkmail_new', [UserController::class, 'bulkmail_new']);
Route::match(['get', 'post'], '/bulkmail_icc', [UserController::class, 'bulkmail_icc']);
Route::match(['get', 'post'], '/bulkmail_icc_bulk', [UserController::class, 'bulkmail_icc_bulk']);
Route::match(['get', 'post'], '/bulkmail_iccnew_bulk', [UserController::class, 'bulkmail_iccnew_bulk']);
Route::match(['get', 'post'], '/bulkmail_iccnew_bulknew', [UserController::class, 'bulkmail_iccnew_bulknew']);
Route::match(['get', 'post'], '/unsubscribe/{email}', [UserController::class, 'unsubscribe']);
Route::match(['get', 'post'], '/registration', [UserController::class, 'registration']);
Route::match(['get', 'post'], '/register-save', [UserController::class, 'registerSave']);
Route::get('/final', [UserController::class, 'downloadAttendeePdf']);
Route::match(['get', 'post'], '/contact', [UserController::class, 'contact']);
Route::match(['get', 'post'], '/exhibition_sponsorship', [UserController::class, 'exhibition_sponsorship']);
Route::match(['get', 'post'], '/registrationnew', [UserController::class, 'registrationnew']);
Route::match(['get', 'post'], '/press_conference', [UserController::class, 'press_conference']);
Route::match(['get', 'post'], '/icgh_event_2023', [UserController::class, 'icgh_event_2023']);
Route::match(['get', 'post'], '/presentation', [UserController::class, 'presentation']);
Route::match(['get', 'post'], '/presentations_2024', [UserController::class, 'presentations']);
Route::match(['get', 'post'], '/reports_2024', [UserController::class, 'reports']);
Route::match(['get', 'post'], '/pictures_2024', [UserController::class, 'pictures_2024']);

// LobbyController Routes
Route::match(['get', 'post'], '/hash/{pwd}', [LobbyController::class, 'hash']);

// Auth routes
Auth::routes();

