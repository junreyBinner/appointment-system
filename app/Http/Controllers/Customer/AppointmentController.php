<?php

namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Inertia\Inertia;

class AppointmentController extends Controller
{
     use AuthorizesRequests;

    public function index()
    {
        $appointments = Appointment::with('service')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return Inertia::render('Customer/Appointments', [
            'appointments' => $appointments,
        ]);
    }

    public function create()
    {
        $services = Service::active()->get();
        $existingAppointments = Appointment::where('date', '>=', now()->format('Y-m-d'))
            ->where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->pluck('date')
            ->map(fn($date) => $date->format('Y-m-d'));

        return Inertia::render('Customer/Book', [
            'services' => $services,
            'bookedDates' => $existingAppointments,
        ]);
    }

    
public function store(Request $request)
{
    $validated = $request->validate([
        'service_id' => 'required|exists:services,id',
        'date' => 'required|date',
        'start_time' => 'required',
        'notes' => 'nullable|string',
    ]);

    $service = Service::findOrFail($validated['service_id']);

    $start = Carbon::parse(
        $validated['date'] . ' ' . $validated['start_time']
    );

    $end = $start->copy()->addMinutes($service->duration_minutes);

    // CONFLICT CHECK HERE
    if (Appointment::hasConflict(
        $service->id,
        $validated['date'],
        $start->format('H:i'),
        $end->format('H:i')
    )) {
        return back()->withErrors([
            'start_time' => 'This time slot is already booked. Please choose another time.',
        ]);
    }

    Appointment::create([
        'user_id' => auth()->id(),
        'service_id' => $service->id,
        'date' => $validated['date'],
        'start_time' => $start->format('H:i'),
        'end_time' => $end->format('H:i'),
        'status' => Appointment::STATUS_PENDING,
        'notes' => $validated['notes'] ?? null,
    ]);

    return redirect()->back()->with('success', 'Appointment booked!');
}

    public function cancel(Appointment $appointment)
    {
        $this->authorize('cancel', $appointment);

        if ($appointment->status !== 'pending') {
            return back()->withErrors([
                'message' => 'Only pending appointments can be cancelled.'
            ]);
        }

        $appointment->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Appointment cancelled.');
    }

   public function dashboard()
{
    $user = auth()->user();

    $stats = [
        'pending' => Appointment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count(),

        'approved' => Appointment::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count(),

        'total' => Appointment::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved', 'completed'])
            ->count(),
    ];
    
    $upcomingAppointments = Appointment::with('service')
        ->where('user_id', $user->id)
        ->whereIn('status', ['pending', 'approved'])
        ->where('date', '>=', now()->format('Y-m-d'))
        ->orderBy('date')
        ->orderBy('start_time')
        ->limit(5)
        ->get();
    
    $services = Service::active()->get();
    
    return Inertia::render('Customer/Dashboard', [
        'stats' => $stats,
        'upcomingAppointments' => $upcomingAppointments,
        'services' => $services,
    ]);
}
}