<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    // No login in this project: "My Appointments" = the bookings made in this browser session.
    public function index()
    {
        return view('appointments.index', [
            'appointments' => Appointment::with('doctor.clinic', 'doctor.specialty')
                ->whereIn('id', session('my_appointments', []))
                ->latest()
                ->get(),
        ]);
    }

    public function store(Request $request, Doctor $doctor)
    {
        $data = $request->validate([
            'patient_name' => ['required', 'string', 'min:2', 'max:100'],
            'phone' => ['required', 'regex:/^[0-9+\-\s]{7,15}$/'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'slot' => ['required', 'string'],
            'notes' => ['nullable', 'string', 'max:500'],
        ], [
            'patient_name.required' => 'Please enter the patient full name.',
            'patient_name.min' => 'Please enter the patient full name.',
            'phone.required' => 'Please enter a valid phone number.',
            'phone.regex' => 'Please enter a valid phone number.',
            'date.required' => 'Please select an appointment date.',
            'date.after_or_equal' => 'The appointment date cannot be in the past.',
        ]);

        [$day, $time] = array_pad(explode('|', $data['slot'], 2), 2, null);
        $schedule = $doctor->schedules()->where('day', $day)->first();

        if (! $schedule || ! in_array($time, $schedule->slots)) {
            throw ValidationException::withMessages(['slot' => 'Please choose one of the doctor\'s available slots.']);
        }
        if (date('l', strtotime($data['date'])) !== $day) {
            throw ValidationException::withMessages(['date' => "The selected date is not a {$day}."]);
        }
        if ($doctor->appointments()->where('date', $data['date'])->where('time_slot', $time)->exists()) {
            throw ValidationException::withMessages(['slot' => 'This slot is already booked on that date.']);
        }

        $appointment = $doctor->appointments()->create([
            'patient_name' => $data['patient_name'],
            'phone' => $data['phone'],
            'date' => $data['date'],
            'time_slot' => "{$day} — {$time}",
            'notes' => $data['notes'] ?: 'General consultation',
        ]);
        $request->session()->push('my_appointments', $appointment->id);

        return redirect()->route('appointments.index')->with('status', "Appointment booked with {$doctor->name}!");
    }

    public function destroy(Appointment $appointment)
    {
        abort_unless(in_array($appointment->id, session('my_appointments', [])), 403);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('status', 'Appointment cancelled.')->with('status_type', 'error');
    }
}
