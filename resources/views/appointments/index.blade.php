@extends('layouts.app')

@section('title', 'My Appointments')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">My Appointments</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">View or cancel scheduled clinic visits</p>
        </div>
        <a href="{{ route('doctors.index') }}" class="self-start sm:self-auto px-4 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs sm:text-sm font-bold smooth-transition">
            + Book Another Appointment
        </a>
    </div>

    @if ($appointments->isNotEmpty())
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/70 border-b border-slate-200 dark:border-slate-800 text-xs uppercase text-slate-500 dark:text-slate-400">
                            <th class="py-3.5 px-4">Reference</th>
                            <th class="py-3.5 px-4">Doctor & Specialty</th>
                            <th class="py-3.5 px-4">Clinic & City</th>
                            <th class="py-3.5 px-4">Patient</th>
                            <th class="py-3.5 px-4">Date & Slot</th>
                            <th class="py-3.5 px-4">Status</th>
                            <th class="py-3.5 px-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @foreach ($appointments as $apt)
                            <tr class="hover:bg-slate-50/70 dark:hover:bg-slate-800/40 smooth-transition">
                                <td class="py-3.5 px-4 font-mono text-xs font-bold text-sky-600 dark:text-sky-400">{{ $apt->reference }}</td>
                                <td class="py-3.5 px-4">
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $apt->doctor->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $apt->doctor->specialty->name }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $apt->doctor->clinic->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $apt->doctor->clinic->city }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $apt->patient_name }}</div>
                                    <div class="text-xs text-slate-500">{{ $apt->phone }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $apt->date->toDateString() }}</div>
                                    <div class="text-xs text-teal-600 dark:text-teal-400 font-semibold">{{ $apt->time_slot }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 text-xs font-bold">{{ $apt->status }}</span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <form method="POST" action="{{ route('appointments.destroy', $apt) }}" onsubmit="return confirm('Cancel this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1.5 rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-950/50 border border-rose-200 dark:border-rose-900/50 smooth-transition">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 p-12 text-center">
            <i class="fas fa-calendar-xmark text-4xl text-slate-300 dark:text-slate-600 mb-3"></i>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">No Appointments Scheduled</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1 mb-5">Browse our doctors and book your first clinic appointment.</p>
            <a href="{{ route('doctors.index') }}" class="px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-sm font-bold smooth-transition">Browse Doctors</a>
        </div>
    @endif
@endsection
