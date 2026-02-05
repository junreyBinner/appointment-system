<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// CUSTOMER CONTROLLERS
use App\Http\Controllers\Customer\AppointmentController as CustomerAppointmentController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\AdminProfileController;

// USER PROFILE CONTROLLER
use App\Http\Controllers\ProfileController;

// ================= HOME =================
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'      => Route::has('login'),
        'canRegister'   => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'    => PHP_VERSION,
    ]);
});


// ================= CUSTOMER ROUTES =================
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {

    Route::get('/dashboard', [CustomerAppointmentController::class, 'dashboard'])
        ->name('dashboard');

    Route::resource('appointments', CustomerAppointmentController::class)
        ->except(['edit', 'update']);

    Route::post('/appointments/{appointment}/cancel', 
        [CustomerAppointmentController::class, 'cancel']
    )->name('appointments.cancel');

    Route::get('/book', 
        [CustomerAppointmentController::class, 'create']
    )->name('book');
});


// ================= ADMIN ROUTES =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', function () {
        return Inertia::render('Admin/Profile/Edit');
    })->name('profile.edit');

    Route::patch('/profile', [AdminProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [AdminProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Services CRUD
    Route::resource('services', ServiceController::class);

    Route::patch('/services/{service}/toggle-status', 
        [ServiceController::class, 'toggleStatus']
    )->name('services.toggle-status');

    // Appointments
    Route::get('/appointments', 
        [AdminAppointmentController::class, 'index']
    )->name('appointments.index');

    Route::patch('/appointments/{appointment}/status', 
        [AdminAppointmentController::class, 'updateStatus']
    )->name('appointments.update-status');

    Route::delete('/appointments/canceled', 
        [AdminAppointmentController::class, 'deleteCanceled']
    )->name('appointments.delete-canceled');
});


// ================= USER PROFILE =================
Route::middleware(['auth'])->group(function () {

    Route::get('/profile', function () {
        return Inertia::render('Profile/Edit');
    })->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


// ================= UNIVERSAL DASHBOARD REDIRECT =================
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {

    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('customer')) {
        return redirect()->route('customer.dashboard');
    }

    abort(403);
})->name('dashboard');


require __DIR__.'/auth.php';
