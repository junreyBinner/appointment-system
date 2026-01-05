<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            
            'pending' => Appointment::where('status', 'pending')->count(),
            'today' => Appointment::whereDate('date', now())->count(),

            
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'total_bookings' => Appointment::count(),
            'inactive_services' => Service::where('is_active', false)->count(),
        ];

        $todaysAppointments = Appointment::with(['user', 'service'])
            ->whereDate('date', now())
            ->whereIn('status', ['pending', 'approved'])
            ->orderBy('start_time')
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'todaysAppointments' => $todaysAppointments,
        ]);
    }
}
