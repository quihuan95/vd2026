<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConferenceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root redirect to Vietnamese site
Route::get('/', function () {
    return redirect('/vi');
});

Route::get('/en/{path?}', function (?string $path = null) {
    $target = '/vi'.($path ? '/'.$path : '');
    $query = request()->getQueryString();

    return redirect($target.($query ? '?'.$query : ''));
})->where('path', '.*');

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Protected Admin Routes
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Registrations
        Route::get('/registrations', [AdminController::class, 'registrations'])->name('admin.registrations');
        Route::get('/registrations/{registration}', [AdminController::class, 'showRegistration'])->name('admin.registrations.show');
        Route::post('/registrations/{registration}/payment', [AdminController::class, 'updateRegistrationPayment'])->name('admin.registrations.payment');
        Route::post('/registrations/{registration}/checkin', [AdminController::class, 'checkInDelegate'])->name('admin.registrations.checkin');
        
        // Abstracts
        Route::get('/abstracts', [AdminController::class, 'abstracts'])->name('admin.abstracts');
        Route::get('/abstracts/{abstract}', [AdminController::class, 'showAbstract'])->name('admin.abstracts.show');
        Route::post('/abstracts/{abstract}/status', [AdminController::class, 'updateAbstractStatus'])->name('admin.abstracts.status');
        
        // Speakers
        Route::get('/speakers', [AdminController::class, 'speakers'])->name('admin.speakers');
        Route::post('/speakers', [AdminController::class, 'storeSpeaker'])->name('admin.speakers.store');
        Route::put('/speakers/{speaker}', [AdminController::class, 'updateSpeaker'])->name('admin.speakers.update');
        Route::delete('/speakers/{speaker}', [AdminController::class, 'deleteSpeaker'])->name('admin.speakers.delete');
        
        // Settings
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
        
        // QR Check-in scanner
        Route::get('/checkin', [AdminController::class, 'checkInScanner'])->name('admin.checkin');
        Route::post('/checkin', [AdminController::class, 'checkInScanner'])->name('admin.checkin.scan');
    });
});

// Conference Public Routes (with locale prefix)
Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'vi'], 'middleware' => ['web', 'locale']], function () {
    Route::get('/', [ConferenceController::class, 'home'])->name('conference.home');
    
    // Explicit submissions
    Route::post('/register', [ConferenceController::class, 'registerSubmit'])->name('conference.register.submit');
    Route::post('/abstract', [ConferenceController::class, 'abstractSubmit'])->name('conference.abstract.submit');
    Route::get('/ticket/{token}', [ConferenceController::class, 'checkTicket'])->name('conference.ticket');
    
    // Whitelisted pages
    Route::get('/{page}', [ConferenceController::class, 'page'])->name('conference.page');
});
