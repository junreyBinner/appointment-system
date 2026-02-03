<?php

use App\Http\Controllers\Customer\AppointmentController as CustomerAppointmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


//  VERIFIED middleware
Route::middleware(['auth',  'role:customer'])->group(function () {
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
Route::middleware(['auth',  'role:admin'])->group(function () {
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
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return Inertia::render('Profile/Edit');
    })->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


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