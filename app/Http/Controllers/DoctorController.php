<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['q', 'specialty', 'city', 'clinic']);

        return view('doctors.index', [
            'doctors' => Doctor::with(['clinic', 'specialty', 'schedules'])->filter($filters)->get(),
            'specialties' => Specialty::all(),
            'cities' => ClinicController::CITIES,
            'filters' => $filters,
            'hasFilters' => collect($filters)->filter()->isNotEmpty(),
        ]);
    }

    public function show(Doctor $doctor)
    {
        return view('doctors.show', ['doctor' => $doctor->load(['clinic', 'specialty', 'schedules'])]);
    }
}
