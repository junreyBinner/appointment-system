<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index()
{
    $services = Service::withCount('appointments')->get();
    
    $stats = [
        'total_services' => Service::count(),
        'active_services' => Service::where('is_active', true)->count(),
        'total_bookings' => Appointment::count(),
    ];
    
    return Inertia::render('Admin/Services/Index', [
        'services' => $services,
        'stats' => $stats,
    ]);
}

    public function create()
    {
        return Inertia::render('Admin/Services/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:5|max:480',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['price'] = $request->filled('price') ? $validated['price'] : null;

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return Inertia::render('Admin/Services/Form', [
            'service' => $service,
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:5|max:480',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['price'] = $request->filled('price') ? $validated['price'] : null;

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }


    public function toggleStatus(Service $service)
{
    $service->update([
        'is_active' => ! $service->is_active,
    ]);

    return back()->with('success', 'Service status updated.');
}


    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}