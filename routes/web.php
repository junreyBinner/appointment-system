<?php

use App\Http\Controllers\Customer\AppointmentController as CustomerAppointmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/verify-otp', [OtpController::class, 'index'])
//     ->name('otp.verify');

// Route::post('/verify-otp', [OtpController::class, 'verify'])
//     ->name('otp.verify.submit');

// Route::post('/resend-otp', [OtpController::class, 'resend'])
//     ->middleware('throttle:3,1')
//     ->name('otp.resend');


// ================= EMAIL VERIFICATION =================

Route::get('/email/verify', function () {
    return Inertia::render('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // optional: redirect depende sa role
    if ($request->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



//  VERIFIED middleware
Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerAppointmentController::class, 'dashboard'])
            ->name('dashboard');
            
        Route::resource('appointments', CustomerAppointmentController::class)
            ->except(['edit', 'update']);
            
        Route::post('/appointments/{appointment}/cancel',
            [CustomerAppointmentController::class, 'cancel']
        )->name('appointments.cancel');
        
        Route::get('/book', [CustomerAppointmentController::class, 'create'])
            ->name('book');
    });
});

//  ADMIN ROUTES with explicit middleware
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');
            
        Route::resource('services', ServiceController::class);
        
        Route::get('/appointments',
            [AdminAppointmentController::class, 'index']
        )->name('appointments.index');
        
        Route::patch('/appointments/{appointment}/status',
            [AdminAppointmentController::class, 'updateStatus']
        )->name('appointments.update-status');

      Route::delete('/appointments/canceled', 
    [AppointmentController::class, 'deleteCanceled']
)->name('appointments.delete-canceled');

Route::patch('/services/{service}/toggle-status', 
  [ServiceController::class, 'toggleStatus']
)->name('services.toggle-status');

    });
});



// ================= USER PROFILE =================
Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Profile/Edit');
    })->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ================= ADMIN PROFILE =================
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Admin/Profile/Edit');
    })->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';