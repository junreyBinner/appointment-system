<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function deleteCanceled()
{
    Appointment::where('status', 'cancelled')->delete();

    return redirect()->back()
        ->with('success', 'All canceled appointments deleted');
}

   public function index(Request $request)
{
    $query = Appointment::with(['user', 'service'])->latest();

    if ($request->filled('date')) {
        $query->where('date', $request->date);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $appointments = $query->paginate(20);

    $cancelledCount = Appointment::where('status', 'cancelled')->count();

    return Inertia::render('Admin/Appointments', [
        'appointments' => $appointments,
        'filters' => $request->only(['date', 'status']),
        'cancelledCount' => $cancelledCount,
    ]);
}


   public function updateStatus(Request $request, Appointment $appointment)
{
    $request->validate([
        'status' => 'required|in:approved,cancelled,completed',
    ]);

    $current = $appointment->status;
    $new = $request->status;

    $allowed = Appointment::STATUS_FLOW[$current] ?? [];

    if (! in_array($new, $allowed)) {
        abort(403, 'Invalid status transition.');
    }

    $appointment->update([
        'status' => $new,
    ]);

    return back()->with('success', 'Appointment status updated.');
}



}